<?php

use Illuminate\Database\Seeder;

class TblklsjabatanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblklsjabatan')->delete();
        
        \DB::table('tblklsjabatan')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_kj' => 'Kelas Jabatan A',
                'jml_butuh' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:20:10',
                'updated_at' => '2019-06-01 05:20:10',
            ),
        ));
        
        
    }
}