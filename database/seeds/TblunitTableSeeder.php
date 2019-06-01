<?php

use Illuminate\Database\Seeder;

class TblunitTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblunit')->delete();
        
        \DB::table('tblunit')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_unit' => 'Unit A',
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:21:03',
                'updated_at' => '2019-06-01 05:21:03',
            ),
            1 => 
            array (
                'ID' => 2,
                'nama_unit' => 'Unit A',
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 05:21:03',
                'updated_at' => '2019-06-01 05:21:03',
            ),
        ));
        
        
    }
}