<?php

namespace App\DataTables;

use App\Models\karyawan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class mppDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'mpp.datatables_actions')->editColumn('Age', function ($inquiry) {
            if ($inquiry->Age == 0) return "<span class='label label-default'>Belum Masa MPP</span>";
            if ($inquiry->Age == 1) return "<span class='label label-warning'>Masa MPP Akan Datang</span>";
            if ($inquiry->Age == 2) return "<span class='label label-danger'>Sudah Masa MPP</span>";
        })
        ->rawColumns(['Age','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\karyawan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(karyawan $model)
    {
        $dt = $model->with(['jabatan','unit','fungsi','klsjabatan'])->newQuery();
        // foreach ($dt as $key => $value) {
        //     $dt['status_mpp'] = $value->age;
        // }
        return $dt;
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
            ['data' => 'unit.nama_unit', 'title' => 'Unit'],
            ['data' => 'jabatan.nama_jabatan', 'title' => 'Jabatan'],
            ['data' => 'fungsi.nama_fungsi', 'title' => 'Fungsi'],
            ['data' => 'klsjabatan.nama_kj', 'title' => 'Kelas Jabatan'],
            ['data' => 'nama', 'title' => 'Nama'],
            ['data' => 'nik', 'title' => 'NIK'],
            ['data' => 'rencana_mpp', 'title' => 'Rencana MPP'],
            ['data' => 'Age', 'title' => 'Status MPP']
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
