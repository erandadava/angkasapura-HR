<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\klsjabatan;
use App\Repositories\klsjabatanRepository;

trait MakeklsjabatanTrait
{
    /**
     * Create fake instance of klsjabatan and save it in database
     *
     * @param array $klsjabatanFields
     * @return klsjabatan
     */
    public function makeklsjabatan($klsjabatanFields = [])
    {
        /** @var klsjabatanRepository $klsjabatanRepo */
        $klsjabatanRepo = \App::make(klsjabatanRepository::class);
        $theme = $this->fakeklsjabatanData($klsjabatanFields);
        return $klsjabatanRepo->create($theme);
    }

    /**
     * Get fake instance of klsjabatan
     *
     * @param array $klsjabatanFields
     * @return klsjabatan
     */
    public function fakeklsjabatan($klsjabatanFields = [])
    {
        return new klsjabatan($this->fakeklsjabatanData($klsjabatanFields));
    }

    /**
     * Get fake data of klsjabatan
     *
     * @param array $klsjabatanFields
     * @return array
     */
    public function fakeklsjabatanData($klsjabatanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_kj' => $fake->word,
            'jml_butuh' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $klsjabatanFields);
    }
}
