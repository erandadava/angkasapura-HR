<?php namespace Tests\Repositories;

use App\Models\karyawan_os;
use App\Repositories\karyawan_osRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makekaryawan_osTrait;
use Tests\ApiTestTrait;

class karyawan_osRepositoryTest extends TestCase
{
    use Makekaryawan_osTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var karyawan_osRepository
     */
    protected $karyawanOsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->karyawanOsRepo = \App::make(karyawan_osRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_karyawan_os()
    {
        $karyawanOs = $this->fakekaryawan_osData();
        $createdkaryawan_os = $this->karyawanOsRepo->create($karyawanOs);
        $createdkaryawan_os = $createdkaryawan_os->toArray();
        $this->assertArrayHasKey('id', $createdkaryawan_os);
        $this->assertNotNull($createdkaryawan_os['id'], 'Created karyawan_os must have id specified');
        $this->assertNotNull(karyawan_os::find($createdkaryawan_os['id']), 'karyawan_os with given id must be in DB');
        $this->assertModelData($karyawanOs, $createdkaryawan_os);
    }

    /**
     * @test read
     */
    public function test_read_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $dbkaryawan_os = $this->karyawanOsRepo->find($karyawanOs->id);
        $dbkaryawan_os = $dbkaryawan_os->toArray();
        $this->assertModelData($karyawanOs->toArray(), $dbkaryawan_os);
    }

    /**
     * @test update
     */
    public function test_update_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $fakekaryawan_os = $this->fakekaryawan_osData();
        $updatedkaryawan_os = $this->karyawanOsRepo->update($fakekaryawan_os, $karyawanOs->id);
        $this->assertModelData($fakekaryawan_os, $updatedkaryawan_os->toArray());
        $dbkaryawan_os = $this->karyawanOsRepo->find($karyawanOs->id);
        $this->assertModelData($fakekaryawan_os, $dbkaryawan_os->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_karyawan_os()
    {
        $karyawanOs = $this->makekaryawan_os();
        $resp = $this->karyawanOsRepo->delete($karyawanOs->id);
        $this->assertTrue($resp);
        $this->assertNull(karyawan_os::find($karyawanOs->id), 'karyawan_os should not exist in DB');
    }
}
