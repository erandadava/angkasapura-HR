<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\tipekar;
use App\Repositories\tipekarRepository;

trait MaketipekarTrait
{
    /**
     * Create fake instance of tipekar and save it in database
     *
     * @param array $tipekarFields
     * @return tipekar
     */
    public function maketipekar($tipekarFields = [])
    {
        /** @var tipekarRepository $tipekarRepo */
        $tipekarRepo = \App::make(tipekarRepository::class);
        $theme = $this->faketipekarData($tipekarFields);
        return $tipekarRepo->create($theme);
    }

    /**
     * Get fake instance of tipekar
     *
     * @param array $tipekarFields
     * @return tipekar
     */
    public function faketipekar($tipekarFields = [])
    {
        return new tipekar($this->faketipekarData($tipekarFields));
    }

    /**
     * Get fake data of tipekar
     *
     * @param array $tipekarFields
     * @return array
     */
    public function faketipekarData($tipekarFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_tipekar' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $tipekarFields);
    }
}
