<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\fungsi;
use App\Repositories\fungsiRepository;

trait MakefungsiTrait
{
    /**
     * Create fake instance of fungsi and save it in database
     *
     * @param array $fungsiFields
     * @return fungsi
     */
    public function makefungsi($fungsiFields = [])
    {
        /** @var fungsiRepository $fungsiRepo */
        $fungsiRepo = \App::make(fungsiRepository::class);
        $theme = $this->fakefungsiData($fungsiFields);
        return $fungsiRepo->create($theme);
    }

    /**
     * Get fake instance of fungsi
     *
     * @param array $fungsiFields
     * @return fungsi
     */
    public function fakefungsi($fungsiFields = [])
    {
        return new fungsi($this->fakefungsiData($fungsiFields));
    }

    /**
     * Get fake data of fungsi
     *
     * @param array $fungsiFields
     * @return array
     */
    public function fakefungsiData($fungsiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_fungsi' => $fake->word,
            'jml_butuh' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $fungsiFields);
    }
}
