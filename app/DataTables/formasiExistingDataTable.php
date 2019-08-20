<?php

namespace App\DataTables;

use App\Models\unitkerja;
use App\Models\klsjabatan;
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
        if($this->dari && $this->sampai){
            $dari = $this->dari;
            $sampai = $this->sampai;
            $unit = \App\Models\unitkerja::withCount(['karyawan' => function($query) use ($dari, $sampai){
                $query->whereBetween('tmt_date', [$dari, $sampai]);
            }])->get();
        }else{
            $unit = \App\Models\unitkerja::withCount('karyawan')->get();
        }
        
        $sum_eksis = 0 ;
        if($unit){
            foreach ($unit as $key => $value) {
                $sum_eksis += (int) $value['karyawan_count'];
            }
            
        }
        return $dataTable->addColumn('action', 'unitkerjas.datatables_actionsformasi')
        ->editColumn('lowong', function ($inquiry) 
        {
            return (int) $inquiry->jml_formasi - (int) $inquiry->karyawan_count;
        })
        ->editColumn('kekuatan', function ($inquiry) 
        {
            if((int) $inquiry->jml_formasi>0){
                return round(((int) $inquiry->karyawan_count / (int) $inquiry->jml_formasi)*100)."%";
            }
            return "0%";
            
        })
        ->editColumn('jml_pkwt', function ($inquiry) use($query)
        {
            $id_pkwt = \App\Models\tipekar::where('nama_tipekar','LIKE','%PKWT%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $pkwt = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pkwt,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_pkwt->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $pkwt = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pkwt){
                    $q->where('id_tipe_kar', $id_pkwt->id);
                }])->first();
            }
            
            return count($pkwt->karyawan);
        })
        ->editColumn('jml_kmpg', function ($inquiry) use($query)
        {
            $id_kmpg = \App\Models\tipekar::where('nama_tipekar','LIKE','%KMPG%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $kmpg = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_kmpg,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_kmpg->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $kmpg = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_kmpg){
                    $q->where('id_tipe_kar', $id_kmpg->id);
                }])->first();
            }
            
            return count($kmpg->karyawan);
        })
        ->editColumn('jml_karyawan', function ($inquiry) use($query)
        {
            $non_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Non Pejabat%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $karyawan = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($non_pejabat,$dari, $sampai){
                    $q->where('id_tipe_kar', $non_pejabat->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $karyawan = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($non_pejabat){
                    $q->where('id_tipe_kar', $non_pejabat->id);
                }])->first();
            }
            
            return count($karyawan->karyawan);
        })

        ->editColumn('jml_pejabat', function ($inquiry) use($query)
        {
            $id_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Pejabat%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $pejabat = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pejabat,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_pejabat->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $pejabat = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pejabat){
                    $q->where('id_tipe_kar', $id_pejabat->id);
                }])->first();
            }
            
            return count($pejabat->karyawan);
        })

        ->editColumn('total_eksis', function ($inquiry) use($query)
        {
            $id_pkwt = \App\Models\tipekar::where('nama_tipekar','LIKE','%PKWT%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $pkwt = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pkwt,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_pkwt->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $pkwt = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pkwt){
                    $q->where('id_tipe_kar', $id_pkwt->id);
                }])->first();
            }
            

            $non_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Non Pejabat%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $karyawan = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($non_pejabat,$dari, $sampai){
                    $q->where('id_tipe_kar', $non_pejabat->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $karyawan = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($non_pejabat){
                    $q->where('id_tipe_kar', $non_pejabat->id);
                }])->first();
            }
            

            $id_kmpg = \App\Models\tipekar::where('nama_tipekar','LIKE','%KMPG%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $kmpg = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_kmpg,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_kmpg->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $kmpg = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_kmpg){
                    $q->where('id_tipe_kar', $id_kmpg->id);
                }])->first();
            }
            
            $id_pejabat = \App\Models\tipekar::where('nama_tipekar','LIKE','%Pejabat%')->first();
            if($this->dari && $this->sampai){
                $dari = $this->dari;
                $sampai = $this->sampai;
                $pejabat = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pejabat,$dari, $sampai){
                    $q->where('id_tipe_kar', $id_pejabat->id)->whereBetween('tmt_date', [$dari, $sampai]);
                }])->first();
            }else{
                $pejabat = \App\Models\unitkerja::where('id','=',$inquiry->id)->with(['karyawan' => function($q) use($id_pejabat){
                    $q->where('id_tipe_kar', $id_pejabat->id);
                }])->first();
            }
            
            
            return count($pejabat->karyawan) + count($karyawan->karyawan) + count($kmpg->karyawan) + count($pkwt->karyawan);
        })
        ->with('sum_formasi', function() use ($query) {
            return $query->sum('jml_formasi');
        })
        ->with('sum_eksis', $sum_eksis)
        ->with('sum_unit', function() use ($query) {
            return $query->count('id');
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

        if($this->dari && $this->sampai){
            $dari = $this->dari;
            $sampai = $this->sampai;
            return $model->withCount(['karyawan' => function($query) use ($dari, $sampai){
                $query->whereBetween('tmt_date', [$dari, $sampai]);
            }])->with(['kategori_unit_kerja'])->newQuery();
        }

        return $model->withCount('karyawan')->with('kategori_unit_kerja')->newQuery();
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
                'order'   => [[0, 'asc']],
                'paging' => false,
                "columnDefs" => [
                    [ "visible" => false, "targets" => [2] ]
                ],
                'buttons' => [
                    
                ],
                'initComplete' => "function () {
                    var rows = this.api().rows( {page:'current'} ).nodes();
                    var last=null;
                    this.api().columns(1).every(function () {
                        var column = this;
                        $(column.footer()).html('TOTAL');
                        
                    });
                    this.api().columns(3).every(function () {
                        var column = this;
                        $(column.footer()).html(LaravelDataTables['dataTableBuilder'].ajax.json().sum_formasi);
                        
                    });
                    this.api().columns(4).every(function () {
                        var column = this;
                        $(column.footer()).html(LaravelDataTables['dataTableBuilder'].ajax.json().sum_eksis);
                        
                    });
                    // Total lowong

                    totalLowong = this.api().column( 5, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(5).every(function () {
                        var column = this;
                        $(column.footer()).html(totalLowong);
                        
                    });

                    // Total kekuatan sdm

                    totalKekuatan = this.api().column( 6, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(6).every(function () {
                        var column = this;
                        $(column.footer()).html(Math.round(parseInt(totalKekuatan))+'%');
                        
                    });

                    // Total pejabat

                    pejabat = this.api().column( 7, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(7).every(function () {
                        var column = this;
                        $(column.footer()).html(pejabat);
                        
                    });

                    // Total jumlahkaryawan

                    jumlahkaryawan = this.api().column( 8, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(8).every(function () {
                        var column = this;
                        $(column.footer()).html(jumlahkaryawan);
                        
                    });

                    // Total jumlahpkwt

                    jumlahpkwt = this.api().column( 9, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(9).every(function () {
                        var column = this;
                        $(column.footer()).html(jumlahpkwt);
                        
                    });

                    // Total jumlahkmpg

                    jumlahkmpg = this.api().column( 10, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(10).every(function () {
                        var column = this;
                        $(column.footer()).html(jumlahkmpg);
                        
                    });

                    // Total totaleksiskanan

                    totaleksiskanan = this.api().column( 11, { page: 'current'} ).data().reduce( function (a, b) {

                    return parseInt(a) + parseInt(b);

                    }, 0 );

                    this.api().columns(11).every(function () {
                        var column = this;
                        $(column.footer()).html(totaleksiskanan);
                        
                    });

                    this.api().column(2, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                '<tr class=group><td colspan=11>'+group+'</td></tr>'
                            );
         
                            last = group;
                        }
                    } );
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
        
        return [
            ['data' => 'id', 'title'=>'id', 'visible' => false],
            ['data'=>'nama_uk','title'=>'Unit Kerja'],
            ['data' => 'kategori_unit_kerja.nama_kategori_uk', 'title'=>'Kategori'],
            ['data'=>'jml_formasi','title'=>'Formasi'],
            ['data'=>'karyawan_count','title'=>'Eksis','searchable' => false],
            ['data'=>'lowong','title'=>'Lowong', 'orderable' => false,'searchable' => false],
            ['data'=>'kekuatan','title'=>'Kekuatan SDM', 'orderable' => false,'searchable' => false],
            ['data'=>'jml_pejabat','title'=>'Pejabat', 'orderable' => false,'searchable' => false],
            ['data'=>'jml_karyawan','title'=>'Karyawan', 'orderable' => false,'searchable' => false],
            ['data'=>'jml_pkwt','title'=>'PKWT', 'orderable' => false,'searchable' => false],
            ['data'=>'jml_kmpg','title'=>'KMPG', 'orderable' => false,'searchable' => false],  
            ['data'=>'total_eksis','title'=>'Total Eksis', 'orderable' => false,'searchable' => false],      
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
