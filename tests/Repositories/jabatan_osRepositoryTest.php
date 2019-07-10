<?php namespace Tests\Repositories;

use App\Models\jabatan_os;
use App\Repositories\jabatan_osRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makejabatan_osTrait;
use Tests\ApiTestTrait;

class jabatan_osRepositoryTest extends TestCase
{
    use Makejabatan_osTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var jabatan_osRepository
     */
    protected $jabatanOsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->jabatanOsRepo = \App::make(jabatan_osRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_jabatan_os()
    {
        $jabatanOs = $this->fakejabatan_osData();
        $createdjabatan_os = $this->jabatanOsRepo->create($jabatanOs);
        $createdjabatan_os = $createdjabatan_os->toArray();
        $this->assertArrayHasKey('id', $createdjabatan_os);
        $this->assertNotNull($createdjabatan_os['id'], 'Created jabatan_os must have id specified');
        $this->assertNotNull(jabatan_os::find($createdjabatan_os['id']), 'jabatan_os with given id must be in DB');
        $this->assertModelData($jabatanOs, $createdjabatan_os);
    }

    /**
     * @test read
     */
    public function test_read_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $dbjabatan_os = $this->jabatanOsRepo->find($jabatanOs->id);
        $dbjabatan_os = $dbjabatan_os->toArray();
        $this->assertModelData($jabatanOs->toArray(), $dbjabatan_os);
    }

    /**
     * @test update
     */
    public function test_update_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $fakejabatan_os = $this->fakejabatan_osData();
        $updatedjabatan_os = $this->jabatanOsRepo->update($fakejabatan_os, $jabatanOs->id);
        $this->assertModelData($fakejabatan_os, $updatedjabatan_os->toArray());
        $dbjabatan_os = $this->jabatanOsRepo->find($jabatanOs->id);
        $this->assertModelData($fakejabatan_os, $dbjabatan_os->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_jabatan_os()
    {
        $jabatanOs = $this->makejabatan_os();
        $resp = $this->jabatanOsRepo->delete($jabatanOs->id);
        $this->assertTrue($resp);
        $this->assertNull(jabatan_os::find($jabatanOs->id), 'jabatan_os should not exist in DB');
    }
}
