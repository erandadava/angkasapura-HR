<?php namespace Tests\Repositories;

use App\Models\karyawan;
use App\Repositories\karyawanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakekaryawanTrait;
use Tests\ApiTestTrait;

class karyawanRepositoryTest extends TestCase
{
    use MakekaryawanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var karyawanRepository
     */
    protected $karyawanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->karyawanRepo = \App::make(karyawanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_karyawan()
    {
        $karyawan = $this->fakekaryawanData();
        $createdkaryawan = $this->karyawanRepo->create($karyawan);
        $createdkaryawan = $createdkaryawan->toArray();
        $this->assertArrayHasKey('id', $createdkaryawan);
        $this->assertNotNull($createdkaryawan['id'], 'Created karyawan must have id specified');
        $this->assertNotNull(karyawan::find($createdkaryawan['id']), 'karyawan with given id must be in DB');
        $this->assertModelData($karyawan, $createdkaryawan);
    }

    /**
     * @test read
     */
    public function test_read_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $dbkaryawan = $this->karyawanRepo->find($karyawan->id);
        $dbkaryawan = $dbkaryawan->toArray();
        $this->assertModelData($karyawan->toArray(), $dbkaryawan);
    }

    /**
     * @test update
     */
    public function test_update_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $fakekaryawan = $this->fakekaryawanData();
        $updatedkaryawan = $this->karyawanRepo->update($fakekaryawan, $karyawan->id);
        $this->assertModelData($fakekaryawan, $updatedkaryawan->toArray());
        $dbkaryawan = $this->karyawanRepo->find($karyawan->id);
        $this->assertModelData($fakekaryawan, $dbkaryawan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_karyawan()
    {
        $karyawan = $this->makekaryawan();
        $resp = $this->karyawanRepo->delete($karyawan->id);
        $this->assertTrue($resp);
        $this->assertNull(karyawan::find($karyawan->id), 'karyawan should not exist in DB');
    }
}
