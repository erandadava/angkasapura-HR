<?php

use Illuminate\Database\Seeder;

class JabatanOsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jabatan_os')->delete();
        
        \DB::table('jabatan_os')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_jabatan' => 'Airport Data Management',
                'created_at' => '2019-07-06 13:29:42',
                'updated_at' => '2019-07-06 13:29:42',
            ),
        ));
        
        
    }
}