<?php

namespace App\DataTables;

use App\Models\karyawan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Carbon\Carbon;
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

        return $dataTable->addColumn('action', 'mpp.datatables_actions')->editColumn('tgl_lahir', function ($inquiry) {

            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
            $m = date('-m-d', strtotime($inquiry->tgl_lahir));
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->year.$m.' 9:30:34');
            $sisa = $to->diffInDays($from);
            $umur =  \Carbon\Carbon::parse($inquiry->tgl_lahir)->age;
            if ((int) $umur == 55 && (int) $sisa < 60 && (int) $sisa > 0) return "<span class='label label-warning'>Masa MPP Akan Datang</span>";
            if ((int) $umur < 55 || (int) $sisa > 60) return "<span class='label label-default'>Belum Masa MPP</span>";
            return "<span class='label label-danger'>Sudah Masa MPP</span>";
            // if($umur == 55 && $sisa < 60 && $sisa > 0){
            //     return "<span class='label label-default'>Belum Masa MPP</span>";
            // }
            // if($umur < 55 || $sisa > 60){
            //     return "<span class='label label-warning'>Masa MPP Akan Datang</span>";
            // }
            
                
        
            // if ($inquiry->Age == 0) return "<span class='label label-default'>Belum Masa MPP</span>";
            // if ($inquiry->Age == 1) return "<span class='label label-warning'>Masa MPP Akan Datang</span>";
            // if ($inquiry->Age == 2) return "<span class='label label-danger'>Sudah Masa MPP</span>";
        })->editColumn('status_pensiun', function ($inquiry) {
            if ($inquiry->status_pensiun == 'A') return "<span class='label label-success'>Sudah Pensiun</span>";
            if ($inquiry->status_pensiun == 'R') return "<span class='label label-danger'>Pensiun Tidak Diambil</span>";
            if ($inquiry->status_pensiun == 'M') return "<span class='label label-warning'>Menunggu Waktu Aktif Pensiun</span>";
            if ($inquiry->status_pensiun == 'N') return "<span class='label label-info'>Belum Pensiun</span>";
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
        return $model->with(['jabatan','unit','fungsi','klsjabatan'])->newQuery();
        // foreach ($dt as $key => $value) {
        //     $dt['status_mpp'] = $value->age;
        // }
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
            ['data' => 'nik', 'title' => 'NIK'],
            ['data' => 'nama', 'title' => 'Nama'],
            ['data' => 'jabatan.nama_jabatan', 'title' => 'Jabatan'],
            ['data' => 'unit.nama_unit', 'title' => 'Unit'],
            ['data' => 'rencana_mpp', 'title' => 'Rencana MPP'],
            ['data' => 'fungsi.nama_fungsi', 'title' => 'Fungsi'],
            ['data' => 'status_pensiun', 'title' => 'Status Pensiun'],
            ['data' => 'tgl_lahir', 'title' => 'Status MPP']
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
