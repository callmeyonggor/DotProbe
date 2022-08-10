<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(int $attempt, int $id)
    {
        $this->id = $id;
        $this->attempt = $attempt;
    }

    public function query()
    {
        return Result::select('user_id','attempt', 'correctness', 'congruency', 'response_time')->where('user_id', $this->id)->where('attempt', $this->attempt);
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Attempt',
            'Correctness',
            'Congruency',
            'Response Time',
        ];
    }
}
