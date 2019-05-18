<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\karyawan;
use App\Repositories\karyawanRepository;

trait MakekaryawanTrait
{
    /**
     * Create fake instance of karyawan and save it in database
     *
     * @param array $karyawanFields
     * @return karyawan
     */
    public function makekaryawan($karyawanFields = [])
    {
        /** @var karyawanRepository $karyawanRepo */
        $karyawanRepo = \App::make(karyawanRepository::class);
        $theme = $this->fakekaryawanData($karyawanFields);
        return $karyawanRepo->create($theme);
    }

    /**
     * Get fake instance of karyawan
     *
     * @param array $karyawanFields
     * @return karyawan
     */
    public function fakekaryawan($karyawanFields = [])
    {
        return new karyawan($this->fakekaryawanData($karyawanFields));
    }

    /**
     * Get fake data of karyawan
     *
     * @param array $karyawanFields
     * @return array
     */
    public function fakekaryawanData($karyawanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'gender' => $fake->word,
            'tgl_lahir' => $fake->date('Y-m-d H:i:s'),
            'id_kj' => $fake->randomDigitNotNull,
            'id_jabatan' => $fake->randomDigitNotNull,
            'id_status1' => $fake->randomDigitNotNull,
            'id_status2' => $fake->randomDigitNotNull,
            'id_unitkerja' => $fake->randomDigitNotNull,
            'rencana_mpp' => $fake->date('Y-m-d H:i:s'),
            'rencana_pensiun' => $fake->date('Y-m-d H:i:s'),
            'pend_diakui' => $fake->word,
            'id_org' => $fake->randomDigitNotNull,
            'id_posisi' => $fake->randomDigitNotNull,
            'id_tipe_kar' => $fake->randomDigitNotNull,
            'entry_date' => $fake->date('Y-m-d H:i:s')
        ], $karyawanFields);
    }
}
