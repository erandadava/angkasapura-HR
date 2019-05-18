<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\jabatan;
use App\Repositories\jabatanRepository;

trait MakejabatanTrait
{
    /**
     * Create fake instance of jabatan and save it in database
     *
     * @param array $jabatanFields
     * @return jabatan
     */
    public function makejabatan($jabatanFields = [])
    {
        /** @var jabatanRepository $jabatanRepo */
        $jabatanRepo = \App::make(jabatanRepository::class);
        $theme = $this->fakejabatanData($jabatanFields);
        return $jabatanRepo->create($theme);
    }

    /**
     * Get fake instance of jabatan
     *
     * @param array $jabatanFields
     * @return jabatan
     */
    public function fakejabatan($jabatanFields = [])
    {
        return new jabatan($this->fakejabatanData($jabatanFields));
    }

    /**
     * Get fake data of jabatan
     *
     * @param array $jabatanFields
     * @return array
     */
    public function fakejabatanData($jabatanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_jabatan' => $fake->word,
            'syarat_didik' => $fake->text,
            'syarat_latih' => $fake->text,
            'syarat_pengalaman' => $fake->text
        ], $jabatanFields);
    }
}
