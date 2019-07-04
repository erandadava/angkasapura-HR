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

        return $dataTable->editColumn('lowong', function ($inquiry) {
            return (int) $inquiry->jml_formasi - (int) $inquiry->karyawan_count;
        })
        ->editColumn('kekuatan', function ($inquiry) {
            return ((int) $inquiry->karyawan_count / (int) $inquiry->jml_formasi)*100 ."%";
        })
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
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
