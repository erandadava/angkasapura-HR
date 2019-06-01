<?php

use Illuminate\Database\Seeder;

class TbltipekarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbltipekar')->delete();
        
        \DB::table('tbltipekar')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_tipekar' => 'Tipe Karyawan A',
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:20:46',
                'updated_at' => '2019-06-01 05:20:46',
            ),
        ));
        
        
    }
}