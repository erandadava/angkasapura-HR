<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\jabatan_os;
use App\Repositories\jabatan_osRepository;

trait Makejabatan_osTrait
{
    /**
     * Create fake instance of jabatan_os and save it in database
     *
     * @param array $jabatanOsFields
     * @return jabatan_os
     */
    public function makejabatan_os($jabatanOsFields = [])
    {
        /** @var jabatan_osRepository $jabatanOsRepo */
        $jabatanOsRepo = \App::make(jabatan_osRepository::class);
        $theme = $this->fakejabatan_osData($jabatanOsFields);
        return $jabatanOsRepo->create($theme);
    }

    /**
     * Get fake instance of jabatan_os
     *
     * @param array $jabatanOsFields
     * @return jabatan_os
     */
    public function fakejabatan_os($jabatanOsFields = [])
    {
        return new jabatan_os($this->fakejabatan_osData($jabatanOsFields));
    }

    /**
     * Get fake data of jabatan_os
     *
     * @param array $jabatanOsFields
     * @return array
     */
    public function fakejabatan_osData($jabatanOsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_jabatan' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $jabatanOsFields);
    }
}
