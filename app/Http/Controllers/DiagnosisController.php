<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Services\DiagnosisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\View\View;

class DiagnosisController extends Controller
{
    public function __construct(
        private DiagnosisService $diagnosisService,
    ) {}

    public function index(): View
    {
        return view('landing.deteksi');
    }

    public function targets(): JsonResponse
    {
        return response()->json([
            'targets' => $this->diagnosisService->getTargets(),
        ]);
    }

    public function symptomsForTarget(string $jenis, int $targetId): JsonResponse
    {
        $this->validateTarget($jenis, $targetId);

        $symptoms = $this->diagnosisService->getSymptomsForTarget($jenis, $targetId);
        $targets = $this->diagnosisService->getTargets();
        $target = $targets->first(
            fn ($t) => $t['jenis'] === $jenis && (int) $t['target_id'] === $targetId
        );

        return response()->json([
            'target' => $target,
            'symptoms' => $symptoms,
        ]);
    }

    public function calculate(Request $request): JsonResponse
    {
        $validated = $this->validateBackwardRequest($request);
        [$selectedIds, $userCfMap] = $this->parseSymptomsInput($validated['symptoms']);

        $result = $this->diagnosisService->calculateForTarget(
            $validated['jenis'],
            (int) $validated['target_id'],
            $selectedIds,
            $userCfMap,
        );

        if (! $result) {
            return response()->json(['message' => 'Gejala tidak valid untuk target ini.'], 422);
        }

        return response()->json(['result' => $result]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateBackwardRequest($request, true);
        [$selectedIds, $userCfMap] = $this->parseSymptomsInput($validated['symptoms']);

        $riwayat = $this->diagnosisService->saveHistoryForTarget(
            jenis: $validated['jenis'],
            targetId: (int) $validated['target_id'],
            selectedGejalaIds: $selectedIds,
            userCfMap: $userCfMap,
            userId: auth()->id(),
            guestName: auth()->check() ? null : $request->input('nama_pengguna'),
            ipAddress: $request->ip(),
        );

        return response()->json([
            'success' => true,
            'message' => 'Riwayat deteksi berhasil disimpan.',
            'riwayat_id' => $riwayat->id,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validateBackwardRequest(Request $request, bool $allowGuestName = false): array
    {
        $rules = [
            'jenis' => ['required', 'string', ValidationRule::in([Rule::JENIS_PENYAKIT, Rule::JENIS_HAMA])],
            'target_id' => 'required|integer|min:1',
            'symptoms' => 'required|array|min:1',
            'symptoms.*.id' => 'required|integer|exists:gejala,id',
            'symptoms.*.user_cf' => ['required', 'numeric', ValidationRule::in(DiagnosisService::allowedUserCfValues())],
        ];

        if ($allowGuestName) {
            $rules['nama_pengguna'] = 'nullable|string|max:100';
        }

        $validated = $request->validate($rules);
        $this->validateTarget($validated['jenis'], (int) $validated['target_id']);

        return $validated;
    }

    private function validateTarget(string $jenis, int $targetId): void
    {
        if (! $this->diagnosisService->targetExists($jenis, $targetId)) {
            abort(404, 'Penyakit/hama tidak ditemukan.');
        }
    }

    /**
     * @param  array<int, array{id: int, user_cf: float}>  $symptoms
     * @return array{0: array<int>, 1: array<int, float>}
     */
    private function parseSymptomsInput(array $symptoms): array
    {
        $selectedIds = [];
        $userCfMap = [];

        foreach ($symptoms as $item) {
            $id = (int) $item['id'];
            $selectedIds[] = $id;
            $userCfMap[$id] = $this->diagnosisService->normalizeUserCf((float) $item['user_cf']);
        }

        return [$selectedIds, $userCfMap];
    }
}
