<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class cekpensiun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cek:pensiun';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek karyawan yang aktif pensiun pada hari ini';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $karyawan = \DB::table('tblkaryawan')
                  ->where([['tgl_aktif_pensiun', '=' ,\Carbon\Carbon::now()->format('Y-m-d')],['status_pensiun','=','M']])
                  ->get();
        foreach($karyawan as $dt){
            \DB::table('tblkaryawan')
                  ->where('id','=',$dt->id)
                  ->update(['status_pensiun' => 'A']);
        }
    }
}
