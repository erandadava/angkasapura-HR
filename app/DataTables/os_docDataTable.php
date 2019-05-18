<?php

namespace App\DataTables;

use App\Models\os_doc;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class os_docDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'os_docs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\os_doc $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(os_doc $model)
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
            'ID',
            'ID_kar',
            'doc_bpsj',
            'doc_bpjsk',
            'doc_lisensi',
            'doc_nomlisensi',
            'jangkawaktu',
            'kontrakkerja'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'os_docsdatatable_' . time();
    }
}
