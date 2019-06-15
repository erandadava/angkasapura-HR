<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Osperformance;
use App\Repositories\OsperformanceRepository;

trait MakeOsperformanceTrait
{
    /**
     * Create fake instance of Osperformance and save it in database
     *
     * @param array $osperformanceFields
     * @return Osperformance
     */
    public function makeOsperformance($osperformanceFields = [])
    {
        /** @var OsperformanceRepository $osperformanceRepo */
        $osperformanceRepo = \App::make(OsperformanceRepository::class);
        $theme = $this->fakeOsperformanceData($osperformanceFields);
        return $osperformanceRepo->create($theme);
    }

    /**
     * Get fake instance of Osperformance
     *
     * @param array $osperformanceFields
     * @return Osperformance
     */
    public function fakeOsperformance($osperformanceFields = [])
    {
        return new Osperformance($this->fakeOsperformanceData($osperformanceFields));
    }

    /**
     * Get fake data of Osperformance
     *
     * @param array $osperformanceFields
     * @return array
     */
    public function fakeOsperformanceData($osperformanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tanggal_pelaporan' => $fake->word,
            'keluhan' => $fake->word,
            'file_pelaporan' => $fake->text,
            'tanggal_penyelesaian' => $fake->word,
            'hasil' => $fake->word,
            'file_penyelesaian' => $fake->text,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $osperformanceFields);
    }
}
