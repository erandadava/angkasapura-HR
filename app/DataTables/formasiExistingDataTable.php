<?php

namespace App\DataTables;

use App\Models\unitkerja;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class formasiExistingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $unit = \App\Models\unitkerja::withCount('karyawan')->get();
        $sum_eksis = 0 ;
        foreach ($unit as $key => $value) {
            $sum_eksis += (int) $value['karyawan_count'];
        }

        return $dataTable->addColumn('action', 'unitkerjas.datatables_actionsformasi')
        ->editColumn('lowong', function ($inquiry) 
        {
            return (int) $inquiry->jml_formasi - (int) $inquiry->karyawan_count;
        })
        ->editColumn('kekuatan', function ($inquiry) 
        {
            return ((int) $inquiry->karyawan_count / (int) $inquiry->jml_formasi)*100 ."%";
        })
        ->with('sum_formasi', function() use ($query) {
            return $query->sum('jml_formasi');
        })
        ->with('sum_eksis', $sum_eksis)
        ->rawColumns(['lowong','kekuatan','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\unitkerja $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(unitkerja $model)
    {
        return $model->withCount('karyawan')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'asc']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
                'initComplete' => "function () {
                    
                    this.api().columns(1).every(function () {
                        var column = this;
                        $(column.footer()).html('Total: ' + LaravelDataTables['dataTableBuilder'].ajax.json().sum_formasi);
                        
                    });
                    this.api().columns(2).every(function () {
                        var column = this;
                        $(column.footer()).html('Total: ' + LaravelDataTables['dataTableBuilder'].ajax.json().sum_eksis);
                        
                    });
                }",
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        // public function getLowonganAttribute()
        // {
        //     return (int) $this->jml_formasi - (int) $this->jml_existing;
        // }

        // public function getKekuatansdmAttribute()
        // {
        //     return ((int) $this->jml_existing / (int) $this->jml_formasi)*100 ."%";
        // }
        return [
            ['data'=>'nama_uk','title'=>'Unit Kerja'],
            ['data'=>'jml_formasi','title'=>'Formasi'],
            ['data'=>'karyawan_count','title'=>'Eksis'],
            ['data'=>'lowong','title'=>'Lowong', 'orderable' => false],
            ['data'=>'kekuatan','title'=>'Kekuatan SDM', 'orderable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'unitkerjasdatatable_' . time();
    }
}
