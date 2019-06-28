<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\fungsi_os;
use App\Repositories\fungsi_osRepository;

trait Makefungsi_osTrait
{
    /**
     * Create fake instance of fungsi_os and save it in database
     *
     * @param array $fungsiOsFields
     * @return fungsi_os
     */
    public function makefungsi_os($fungsiOsFields = [])
    {
        /** @var fungsi_osRepository $fungsiOsRepo */
        $fungsiOsRepo = \App::make(fungsi_osRepository::class);
        $theme = $this->fakefungsi_osData($fungsiOsFields);
        return $fungsiOsRepo->create($theme);
    }

    /**
     * Get fake instance of fungsi_os
     *
     * @param array $fungsiOsFields
     * @return fungsi_os
     */
    public function fakefungsi_os($fungsiOsFields = [])
    {
        return new fungsi_os($this->fakefungsi_osData($fungsiOsFields));
    }

    /**
     * Get fake data of fungsi_os
     *
     * @param array $fungsiOsFields
     * @return array
     */
    public function fakefungsi_osData($fungsiOsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_fungsi' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $fungsiOsFields);
    }
}
