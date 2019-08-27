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

        return $dataTable->addColumn('action', 'karyawans.datatables_actions')->editColumn('tgl_lahir', function ($inquiry) 
        {
            
        })
        ->editColumn('tgl_lahir', function ($inquiry) 
            {
             return \Carbon\Carbon::parse($inquiry->tgl_lahir)->formatLocalized('%d %B %Y');
            })
        ->editColumn('jabatan.nama_jabatan', function ($inquiry) 
            {
                $cek_log = $this->check_log($inquiry->id);
                if($cek_log != null){
                    return $cek_log->jabatan->nama_jabatan ?? "";
                }else{
                    return $inquiry->jabatan->nama_jabatan ?? "";
                }
            })
        ->editColumn('unitkerja.nama_uk', function ($inquiry) 
            {
                $cek_log = $this->check_log($inquiry->id);
                if($cek_log != null){
                    return $cek_log->unitkerja->nama_uk ?? "";
                }else{
                    return $inquiry->unitkerja->nama_uk ?? "";
                }
            })
        ->editColumn('klsjabatan.nama_kj', function ($inquiry) 
            {
                $cek_log = $this->check_log($inquiry->id);
                if($cek_log != null){
                    return $cek_log->klsjabatan->nama_kj ?? "";
                }else{
                    return $inquiry->klsjabatan->nama_kj ?? "";
                }
            })

        ->rawColumns(['tgl_lahir','status_pensiun','action']);
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
            ['data'=>'jabatan.nama_jabatan','title'=>'Jabatan'],
            ['data'=>'unitkerja.nama_uk','title'=>'Unit Kerja'],
            ['data'=>'klsjabatan.nama_kj','title'=>'Kelas Jabatan'],
            ['data'=>'gender','title'=>'Gender'],
            ['data'=>'tgl_lahir','title'=>'Tanggal Lahir'],
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

    public function check_log($id_karyawan){
        $cek = \App\Models\log_karyawan::where('id_karyawan_fk','=',$id_karyawan)->with(['fungsi','jabatan','unitkerja','tipekar','unit','klsjabatan'])->latest('update_date')->first();
        if($cek){
            return $cek;
        }else{
            return null;
        }
    }    
}
