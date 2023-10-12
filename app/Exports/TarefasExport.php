<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TarefasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Tarefa::all();
        return auth()->user()->tarefas()->get();
    }
    public function headings(): array
    {
        return [
            'ID da Tarefa',
        'ID do Usuario',
        'Tarefa',
        'Data limite conclusão',
        'Data Criação',
        'Data atualização'
    ];
    }
}
