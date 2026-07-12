<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RulesCfExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\RuleRequest;
use App\Models\Gejala;
use App\Models\Hama;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RuleController extends Controller
{
    public function index(Request $request): View
    {
        $jenis = $request->query('jenis');

        $rules = $this->buildFilteredRulesQuery($request)
            ->with(['details.gejala'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $rules->getCollection()->transform(function (Rule $rule) {
            $target = $rule->target();
            $rule->setRelation('targetModel', $target);

            return $rule;
        });

        return view('admin.rules.index', compact('rules', 'jenis'));
    }

    public function export(Request $request): StreamedResponse
    {
        $rules = $this->buildFilteredRulesQuery($request)
            ->with(['details.gejala'])
            ->latest()
            ->get();

        $filename = 'rules-cf-' . now()->format('Y-m-d-His') . '.xlsx';

        return (new RulesCfExport($rules))->download($filename);
    }

    public function create(Request $request): View
    {
        return view('admin.rules.create', array_merge(
            $this->ruleLists(),
            [
                'rule' => new Rule(),
                'selectedGejala' => [],
            ]
        ));
    }

    public function store(RuleRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $rule = Rule::create([
                'jenis' => $request->input('jenis'),
                'target_id' => (int) $request->input('target_id'),
            ]);

            foreach ($request->normalizedGejala() as $row) {
                $rule->details()->create($row);
            }
        });

        return redirect()
            ->route('rules.index')
            ->with('success', 'Rule berhasil ditambahkan.');
    }

    public function edit(Request $request, Rule $rule): View
    {
        $rule->load('details.gejala');

        $selectedGejala = $rule->details->map(fn ($detail) => [
            'id' => $detail->gejala_id,
            'nilai_cf' => (float) $detail->nilai_cf,
        ])->keyBy('id')->all();

        return view('admin.rules.edit', array_merge(
            $this->ruleLists(),
            [
                'rule' => $rule,
                'selectedGejala' => $selectedGejala,
            ]
        ));
    }

    public function update(RuleRequest $request, Rule $rule): RedirectResponse
    {
        DB::transaction(function () use ($request, $rule) {
            $rule->update([
                'jenis' => $request->input('jenis'),
                'target_id' => (int) $request->input('target_id'),
            ]);

            $rule->details()->delete();

            foreach ($request->normalizedGejala() as $row) {
                $rule->details()->create($row);
            }
        });

        return redirect()
            ->route('rules.index')
            ->with('success', 'Rule berhasil diperbarui.');
    }

    public function destroy(Rule $rule): RedirectResponse
    {
        $rule->delete();

        return redirect()
            ->route('rules.index')
            ->with('success', 'Rule berhasil dihapus.');
    }

    /** @return array<string, mixed> */
    private function ruleLists(): array
    {
        return [
            'gejalaList' => Gejala::orderBy('kode_gejala')->get(),
            'penyakitList' => Penyakit::orderBy('kode_penyakit')->get(),
            'hamaList' => Hama::orderBy('kode_hama')->get(),
        ];
    }

    private function buildFilteredRulesQuery(Request $request): Builder
    {
        $jenis = $request->query('jenis');

        return Rule::query()
            ->when(in_array($jenis, ['penyakit', 'hama'], true), fn ($q) => $q->where('jenis', $jenis));
    }
}
