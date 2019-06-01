<?php

use Illuminate\Database\Seeder;

class TbljabatanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbljabatan')->delete();
        
        \DB::table('tbljabatan')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_jabatan' => 'Jabatan A',
                'syarat_didik' => 'A',
                'syarat_latih' => 'A',
                'syarat_pengalaman' => 'A',
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:07:46',
                'updated_at' => '2019-06-01 05:07:46',
            ),
        ));
        
        
    }
}