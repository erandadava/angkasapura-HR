<?php

use Illuminate\Database\Seeder;

class TblkaryawanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblkaryawan')->delete();
        
        \DB::table('tblkaryawan')->insert(array (
            0 => 
            array (
                'ID' => 1,
                'nama' => 'adi',
                'gender' => 'Laki-laki',
                'tgl_lahir' => '1964-04-10',
                'id_kj' => 1,
                'id_jabatan' => 1,
                'id_klsjabatan' => 1,
                'id_status1' => 1,
                'id_status2' => 1,
                'id_unitkerja' => 1,
                'id_unit' => 1,
                'rencana_mpp' => '2019-03-26',
                'rencana_pensiun' => '2019-03-11',
                'pend_diakui' => '1',
                'id_org' => 1,
                'id_posisi' => 1,
                'id_tipe_kar' => 1,
                'id_fungsi' => 1,
                'nik' => '201688475',
                'entry_date' => '2019-08-18 09:08:20',
                'created_at' => '2019-06-01 06:17:27',
                'updated_at' => '2019-06-01 06:17:27',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}