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
        return $model->with(['klsjabatan','jabatan','unitkerja'])->newQuery();
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
            ['data'=>'nik','title'=>'NIK'],
            ['data'=>'nama','title'=>'Nama'],
            ['data'=>'gender','title'=>'Gender'],
            ['data'=>'tgl_lahir','title'=>'Tanggal Lahir'],
            ['data'=>'jabatan.nama_jabatan','title'=>'Jabatan'],
            ['data'=>'klsjabatan.nama_kj','title'=>'Kelas Jabatan'],
            ['data'=>'unitkerja.nama_uk','title'=>'Unit Kerja'],
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
