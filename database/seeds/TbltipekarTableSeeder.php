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
                'id' => 2,
                'nama_tipekar' => 'Pejabat',
                'deleted_at' => NULL,
                'created_at' => '2019-08-13 14:16:36',
                'updated_at' => '2019-08-13 14:16:36',
            ),
            1 => 
            array (
                'id' => 3,
                'nama_tipekar' => 'Non Pejabat',
                'deleted_at' => NULL,
                'created_at' => '2019-08-13 14:16:46',
                'updated_at' => '2019-08-13 14:16:46',
            ),
            2 => 
            array (
                'id' => 4,
                'nama_tipekar' => 'PKWT',
                'deleted_at' => NULL,
                'created_at' => '2019-08-13 14:16:55',
                'updated_at' => '2019-08-13 14:16:55',
            ),
            3 => 
            array (
                'id' => 5,
                'nama_tipekar' => 'KMPG',
                'deleted_at' => NULL,
                'created_at' => '2019-08-13 14:17:07',
                'updated_at' => '2019-08-13 14:17:07',
            ),
        ));
        
        
    }
}