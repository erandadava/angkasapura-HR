<?php namespace Tests\Repositories;

use App\Models\kategori_unit_kerja;
use App\Repositories\kategori_unit_kerjaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makekategori_unit_kerjaTrait;
use Tests\ApiTestTrait;

class kategori_unit_kerjaRepositoryTest extends TestCase
{
    use Makekategori_unit_kerjaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var kategori_unit_kerjaRepository
     */
    protected $kategoriUnitKerjaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kategoriUnitKerjaRepo = \App::make(kategori_unit_kerjaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->fakekategori_unit_kerjaData();
        $createdkategori_unit_kerja = $this->kategoriUnitKerjaRepo->create($kategoriUnitKerja);
        $createdkategori_unit_kerja = $createdkategori_unit_kerja->toArray();
        $this->assertArrayHasKey('id', $createdkategori_unit_kerja);
        $this->assertNotNull($createdkategori_unit_kerja['id'], 'Created kategori_unit_kerja must have id specified');
        $this->assertNotNull(kategori_unit_kerja::find($createdkategori_unit_kerja['id']), 'kategori_unit_kerja with given id must be in DB');
        $this->assertModelData($kategoriUnitKerja, $createdkategori_unit_kerja);
    }

    /**
     * @test read
     */
    public function test_read_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $dbkategori_unit_kerja = $this->kategoriUnitKerjaRepo->find($kategoriUnitKerja->id);
        $dbkategori_unit_kerja = $dbkategori_unit_kerja->toArray();
        $this->assertModelData($kategoriUnitKerja->toArray(), $dbkategori_unit_kerja);
    }

    /**
     * @test update
     */
    public function test_update_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $fakekategori_unit_kerja = $this->fakekategori_unit_kerjaData();
        $updatedkategori_unit_kerja = $this->kategoriUnitKerjaRepo->update($fakekategori_unit_kerja, $kategoriUnitKerja->id);
        $this->assertModelData($fakekategori_unit_kerja, $updatedkategori_unit_kerja->toArray());
        $dbkategori_unit_kerja = $this->kategoriUnitKerjaRepo->find($kategoriUnitKerja->id);
        $this->assertModelData($fakekategori_unit_kerja, $dbkategori_unit_kerja->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kategori_unit_kerja()
    {
        $kategoriUnitKerja = $this->makekategori_unit_kerja();
        $resp = $this->kategoriUnitKerjaRepo->delete($kategoriUnitKerja->id);
        $this->assertTrue($resp);
        $this->assertNull(kategori_unit_kerja::find($kategoriUnitKerja->id), 'kategori_unit_kerja should not exist in DB');
    }
}
