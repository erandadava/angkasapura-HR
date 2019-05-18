<?php

namespace App\DataTables;

use App\Models\karyawan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class karyawanDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'karyawans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\karyawan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(karyawan $model)
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
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'nama',
            'gender',
            'tgl_lahir',
            'id_kj',
            'id_jabatan',
            'id_status1',
            'id_status2',
            'id_unitkerja',
            'rencana_mpp',
            'rencana_pensiun',
            'pend_diakui',
            'id_org',
            'id_posisi',
            'id_tipe_kar',
            'entry_date'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'karyawansdatatable_' . time();
    }
}
