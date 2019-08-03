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
                'id' => 1,
                'nama_fungsi' => 'Airport Operation',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
            'nama_fungsi' => 'Apron Movement Control (AMC)',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
            'nama_fungsi' => 'Rescue Fire Fighting Safety (RFFS)',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nama_fungsi' => 'AVSEC',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nama_fungsi' => 'Airport Service',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nama_fungsi' => ' Terminal Inspection Service ',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nama_fungsi' => 'Customer Service',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nama_fungsi' => 'Digital Service',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nama_fungsi' => 'Civil',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nama_fungsi' => 'Electronic',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nama_fungsi' => 'ELECTRICAL',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nama_fungsi' => 'MECHANICAL',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nama_fungsi' => 'Terminal Inspection Service',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'nama_fungsi' => ' Customer Service ',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'nama_fungsi' => ' Digital Service ',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'nama_fungsi' => ' Electrical',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'nama_fungsi' => 'INFORMATION TECHNOLOGY',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'nama_fungsi' => 'FINANCE',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'nama_fungsi' => 'Human Capital',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'nama_fungsi' => 'General Affairs',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'nama_fungsi' => 'Compliance & Risk',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'nama_fungsi' => 'Public Relation',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'nama_fungsi' => 'LEGAL',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'nama_fungsi' => 'PROCUREMENT',
                'jml_butuh' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}