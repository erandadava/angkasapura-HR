<?php

use Illuminate\Database\Seeder;

class TblunitkerjaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblunitkerja')->delete();
        
        \DB::table('tblunitkerja')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'EXECUTIVE GENERAL MANAGER',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'BANDARA SOEKARNO-HATTA',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'OFFICER IN CHARGE',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRPORT OPERATION',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRSIDE OPERATION & ARFF',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' AIRSIDE OPERATION & ARFF ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRPORT SECURITY',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' AIRPORT SECURITY ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRPORT SERVICES & FACILITY',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'TERMINAL SERVICE & FACILITY – T1',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' TERMINAL SERVICE & FACILITY – T1 ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'TERMINAL SERVICE & FACILITY – T2',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' TERMINAL SERVICE & FACILITY – T2 ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'TERMINAL SERVICE & FACILITY - T3',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' TERMINAL SERVICE & FACILITY - T3 ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'LANDSIDE SERVICE & FACILITY  ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' LANDSIDE SERVICE & FACILITY   ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRPORT MAINTENANCE',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AIRSIDE INFRASTRUCTURE & SUPPORT',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' AIRSIDE INFRASTRUCTURE & SUPPORT ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'ELECTRICAL & MECHANICAL',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' ELECTRICAL & MECHANICAL ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'INFORMATION TECHNOLOGY',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' INFORMATION TECHNOLOGY ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'FINANCE & HUMAN RESOURCES ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'FINANCE',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' FINANCE ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'ASSETS & LOGISTIC MANAGEMENT',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' ASSETS & LOGISTIC MANAGEMENT ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'HUMAN RESOURCES & GENERAL AFFAIRS',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' HUMAN RESOURCES & GENERAL AFFAIRS ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'AOCC',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'SAFETY, RISK, & QUALITY CONTROL',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' SAFETY, RISK, & QUALITY CONTROL ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'BRANCH COMMUNICATION & LEGAL',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' BRANCH COMMUNICATION & LEGAL ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => 'PROCUREMENT',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'id_kategori_unit_kerja_fk' => NULL,
                'nama_uk' => ' PROCUREMENT ',
                'jml_formasi' => 20,
                'jml_existing' => 0,
                'deleted_at' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}