<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\statuskar;
use App\Repositories\statuskarRepository;

trait MakestatuskarTrait
{
    /**
     * Create fake instance of statuskar and save it in database
     *
     * @param array $statuskarFields
     * @return statuskar
     */
    public function makestatuskar($statuskarFields = [])
    {
        /** @var statuskarRepository $statuskarRepo */
        $statuskarRepo = \App::make(statuskarRepository::class);
        $theme = $this->fakestatuskarData($statuskarFields);
        return $statuskarRepo->create($theme);
    }

    /**
     * Get fake instance of statuskar
     *
     * @param array $statuskarFields
     * @return statuskar
     */
    public function fakestatuskar($statuskarFields = [])
    {
        return new statuskar($this->fakestatuskarData($statuskarFields));
    }

    /**
     * Get fake data of statuskar
     *
     * @param array $statuskarFields
     * @return array
     */
    public function fakestatuskarData($statuskarFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_stat' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $statuskarFields);
    }
}
