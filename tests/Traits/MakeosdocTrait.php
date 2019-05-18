<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\osdoc;
use App\Repositories\osdocRepository;

trait MakeosdocTrait
{
    /**
     * Create fake instance of osdoc and save it in database
     *
     * @param array $osdocFields
     * @return osdoc
     */
    public function makeosdoc($osdocFields = [])
    {
        /** @var osdocRepository $osdocRepo */
        $osdocRepo = \App::make(osdocRepository::class);
        $theme = $this->fakeosdocData($osdocFields);
        return $osdocRepo->create($theme);
    }

    /**
     * Get fake instance of osdoc
     *
     * @param array $osdocFields
     * @return osdoc
     */
    public function fakeosdoc($osdocFields = [])
    {
        return new osdoc($this->fakeosdocData($osdocFields));
    }

    /**
     * Get fake data of osdoc
     *
     * @param array $osdocFields
     * @return array
     */
    public function fakeosdocData($osdocFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'ID' => $fake->randomDigitNotNull,
            'ID_kar' => $fake->randomDigitNotNull,
            'doc_bpsj' => $fake->text,
            'doc_bpjsk' => $fake->text,
            'doc_lisensi' => $fake->text,
            'doc_nomlisensi' => $fake->text,
            'jangkawaktu' => $fake->text,
            'kontrakkerja' => $fake->text,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $osdocFields);
    }
}
