<?php

namespace App\DataTables;

use App\Models\jabatan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class jabatanDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'jabatans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\jabatan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(jabatan $model)
    {
        return $model->newQuery();
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
        return [
            ['data' => 'ID', 'visible'=> false],
            ['data' => 'nama_jabatan', 'title' => 'Nama Jabatan'],
            ['data' => 'syarat_didik', 'title' => 'Pendidikan'],
            ['data' => 'syarat_latih', 'title' => 'Pelatihan'],
            ['data' => 'syarat_pengalaman', 'title' => 'Pengalaman']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'jabatansdatatable_' . time();
    }
}
