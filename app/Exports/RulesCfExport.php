<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RulesCfExport
{
    public function __construct(
        private Collection $rules,
    ) {}

    public function download(string $filename): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Rules CF');

        $headers = ['No', 'Jenis', 'Kode Target', 'Nama Target', 'Kode Gejala', 'Nama Gejala', 'Nilai CF'];
        $sheet->fromArray($headers, null, 'A1');

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE2F0E9');

        $row = 2;
        $no = 1;

        foreach ($this->rules as $rule) {
            $jenis = ucfirst($rule->jenis);
            $kodeTarget = $rule->target_code ?? '—';
            $namaTarget = $rule->target_name ?? '— target dihapus —';

            if ($rule->details->isEmpty()) {
                $sheet->fromArray([$no++, $jenis, $kodeTarget, $namaTarget, '', '', ''], null, "A{$row}");
                $row++;

                continue;
            }

            foreach ($rule->details as $detail) {
                $sheet->fromArray([
                    $no++,
                    $jenis,
                    $kodeTarget,
                    $namaTarget,
                    $detail->gejala?->kode_gejala ?? '?',
                    $detail->gejala?->nama_gejala ?? '',
                    (float) $detail->nilai_cf,
                ], null, "A{$row}");
                $row++;
            }
        }

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->getStyle("G2:G{$row}")
            ->getNumberFormat()
            ->setFormatCode('0.00');

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
