<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\kategori_unit_kerja;
use App\Repositories\kategori_unit_kerjaRepository;

trait Makekategori_unit_kerjaTrait
{
    /**
     * Create fake instance of kategori_unit_kerja and save it in database
     *
     * @param array $kategoriUnitKerjaFields
     * @return kategori_unit_kerja
     */
    public function makekategori_unit_kerja($kategoriUnitKerjaFields = [])
    {
        /** @var kategori_unit_kerjaRepository $kategoriUnitKerjaRepo */
        $kategoriUnitKerjaRepo = \App::make(kategori_unit_kerjaRepository::class);
        $theme = $this->fakekategori_unit_kerjaData($kategoriUnitKerjaFields);
        return $kategoriUnitKerjaRepo->create($theme);
    }

    /**
     * Get fake instance of kategori_unit_kerja
     *
     * @param array $kategoriUnitKerjaFields
     * @return kategori_unit_kerja
     */
    public function fakekategori_unit_kerja($kategoriUnitKerjaFields = [])
    {
        return new kategori_unit_kerja($this->fakekategori_unit_kerjaData($kategoriUnitKerjaFields));
    }

    /**
     * Get fake data of kategori_unit_kerja
     *
     * @param array $kategoriUnitKerjaFields
     * @return array
     */
    public function fakekategori_unit_kerjaData($kategoriUnitKerjaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama_kategori_uk' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $kategoriUnitKerjaFields);
    }
}
