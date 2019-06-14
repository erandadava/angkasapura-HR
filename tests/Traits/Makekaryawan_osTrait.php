<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\karyawan_os;
use App\Repositories\karyawan_osRepository;

trait Makekaryawan_osTrait
{
    /**
     * Create fake instance of karyawan_os and save it in database
     *
     * @param array $karyawanOsFields
     * @return karyawan_os
     */
    public function makekaryawan_os($karyawanOsFields = [])
    {
        /** @var karyawan_osRepository $karyawanOsRepo */
        $karyawanOsRepo = \App::make(karyawan_osRepository::class);
        $theme = $this->fakekaryawan_osData($karyawanOsFields);
        return $karyawanOsRepo->create($theme);
    }

    /**
     * Get fake instance of karyawan_os
     *
     * @param array $karyawanOsFields
     * @return karyawan_os
     */
    public function fakekaryawan_os($karyawanOsFields = [])
    {
        return new karyawan_os($this->fakekaryawan_osData($karyawanOsFields));
    }

    /**
     * Get fake data of karyawan_os
     *
     * @param array $karyawanOsFields
     * @return array
     */
    public function fakekaryawan_osData($karyawanOsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'id_fungsi' => $fake->randomDigitNotNull,
            'id_unitkerja' => $fake->randomDigitNotNull,
            'tgl_lahir' => $fake->word,
            'usia' => $fake->randomDigitNotNull,
            'gender' => $fake->word,
            'no_bpjs_tk' => $fake->word,
            'doc_no_bpjs_tk' => $fake->text,
            'no_bpjs_kesehatan' => $fake->word,
            'doc_no_bpjs_kesehatan' => $fake->text,
            'lisensi' => $fake->word,
            'doc_lisensi' => $fake->text,
            'no_lisensi' => $fake->word,
            'doc_no_lisensi' => $fake->text,
            'jangka_waktu' => $fake->word,
            'doc_jangka_waktu' => $fake->text,
            'no_kontrak_kerja' => $fake->word,
            'doc_no_kontrak_kerja' => $fake->text,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $karyawanOsFields);
    }
}
