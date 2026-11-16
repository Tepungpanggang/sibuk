<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class LoansExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithCustomValueBinder
{
    protected Collection $loans;

    public function __construct(Collection $loans)
    {
        $this->loans = $loans;
    }

    public function collection()
    {
        return $this->loans->values()->map(function ($loan, $index) {
            return [
                'No' => $index + 1,
                'Siswa' => $loan->user->name,
                'Buku' => $loan->book->title,
                'Tgl Pinjam' => optional($loan->loan_date)->format('Y-m-d'),
                'Jatuh Tempo' => optional($loan->due_date)->format('Y-m-d'),
                'Tgl Kembali' => optional($loan->returned_at)->format('Y-m-d'),
                'Status' => $loan->status,
                'Denda' => $loan->fine->amount ?? 0,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Siswa', 'Buku', 'Tgl Pinjam', 'Jatuh Tempo', 'Tgl Kembali', 'Status', 'Denda'];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_string($value) && str_starts_with($value, '=')) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}