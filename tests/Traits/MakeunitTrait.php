<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\unit;
use App\Repositories\unitRepository;

trait MakeunitTrait
{
    /**
     * Create fake instance of unit and save it in database
     *
     * @param array $unitFields
     * @return unit
     */
    public function makeunit($unitFields = [])
    {
        /** @var unitRepository $unitRepo */
        $unitRepo = \App::make(unitRepository::class);
        $theme = $this->fakeunitData($unitFields);
        return $unitRepo->create($theme);
    }

    /**
     * Get fake instance of unit
     *
     * @param array $unitFields
     * @return unit
     */
    public function fakeunit($unitFields = [])
    {
        return new unit($this->fakeunitData($unitFields));
    }

    /**
     * Get fake data of unit
     *
     * @param array $unitFields
     * @return array
     */
    public function fakeunitData($unitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_unit' => $fake->word
        ], $unitFields);
    }
}
