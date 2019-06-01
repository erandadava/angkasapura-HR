<?php

use Illuminate\Database\Seeder;

class TblfungsiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblfungsi')->delete();
        
        \DB::table('tblfungsi')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama_fungsi' => 'Fungsi A',
                'jml_butuh' => 1,
                'deleted_at' => NULL,
                'created_at' => '2019-06-01 07:44:46',
                'updated_at' => '2019-06-01 07:44:46',
            ),
        ));
        
        
    }
}