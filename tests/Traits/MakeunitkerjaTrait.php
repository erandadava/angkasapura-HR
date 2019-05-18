<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\unitkerja;
use App\Repositories\unitkerjaRepository;

trait MakeunitkerjaTrait
{
    /**
     * Create fake instance of unitkerja and save it in database
     *
     * @param array $unitkerjaFields
     * @return unitkerja
     */
    public function makeunitkerja($unitkerjaFields = [])
    {
        /** @var unitkerjaRepository $unitkerjaRepo */
        $unitkerjaRepo = \App::make(unitkerjaRepository::class);
        $theme = $this->fakeunitkerjaData($unitkerjaFields);
        return $unitkerjaRepo->create($theme);
    }

    /**
     * Get fake instance of unitkerja
     *
     * @param array $unitkerjaFields
     * @return unitkerja
     */
    public function fakeunitkerja($unitkerjaFields = [])
    {
        return new unitkerja($this->fakeunitkerjaData($unitkerjaFields));
    }

    /**
     * Get fake data of unitkerja
     *
     * @param array $unitkerjaFields
     * @return array
     */
    public function fakeunitkerjaData($unitkerjaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_uk' => $fake->word,
            'jml_formasi' => $fake->randomDigitNotNull,
            'jml_existing' => $fake->randomDigitNotNull
        ], $unitkerjaFields);
    }
}
