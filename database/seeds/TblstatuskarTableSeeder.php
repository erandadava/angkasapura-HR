<?php

use Illuminate\Database\Seeder;

class TblstatuskarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblstatuskar')->delete();
        
        \DB::table('tblstatuskar')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_stat' => 'Status Karyawan A',
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:20:31',
                'updated_at' => '2019-06-01 05:20:31',
            ),
        ));
        
        
    }
}