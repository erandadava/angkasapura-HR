<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\vendor_os;
use App\Repositories\vendor_osRepository;

trait Makevendor_osTrait
{
    /**
     * Create fake instance of vendor_os and save it in database
     *
     * @param array $vendorOsFields
     * @return vendor_os
     */
    public function makevendor_os($vendorOsFields = [])
    {
        /** @var vendor_osRepository $vendorOsRepo */
        $vendorOsRepo = \App::make(vendor_osRepository::class);
        $theme = $this->fakevendor_osData($vendorOsFields);
        return $vendorOsRepo->create($theme);
    }

    /**
     * Get fake instance of vendor_os
     *
     * @param array $vendorOsFields
     * @return vendor_os
     */
    public function fakevendor_os($vendorOsFields = [])
    {
        return new vendor_os($this->fakevendor_osData($vendorOsFields));
    }

    /**
     * Get fake data of vendor_os
     *
     * @param array $vendorOsFields
     * @return array
     */
    public function fakevendor_osData($vendorOsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_vendor' => $fake->word,
            'email' => $fake->word,
            'password' => $fake->word,
            'telepon' => $fake->word,
            'alamat' => $fake->word,
            'is_active' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $vendorOsFields);
    }
}
