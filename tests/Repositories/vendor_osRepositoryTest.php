<?php namespace Tests\Repositories;

use App\Models\vendor_os;
use App\Repositories\vendor_osRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makevendor_osTrait;
use Tests\ApiTestTrait;

class vendor_osRepositoryTest extends TestCase
{
    use Makevendor_osTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var vendor_osRepository
     */
    protected $vendorOsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->vendorOsRepo = \App::make(vendor_osRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_vendor_os()
    {
        $vendorOs = $this->fakevendor_osData();
        $createdvendor_os = $this->vendorOsRepo->create($vendorOs);
        $createdvendor_os = $createdvendor_os->toArray();
        $this->assertArrayHasKey('id', $createdvendor_os);
        $this->assertNotNull($createdvendor_os['id'], 'Created vendor_os must have id specified');
        $this->assertNotNull(vendor_os::find($createdvendor_os['id']), 'vendor_os with given id must be in DB');
        $this->assertModelData($vendorOs, $createdvendor_os);
    }

    /**
     * @test read
     */
    public function test_read_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $dbvendor_os = $this->vendorOsRepo->find($vendorOs->id);
        $dbvendor_os = $dbvendor_os->toArray();
        $this->assertModelData($vendorOs->toArray(), $dbvendor_os);
    }

    /**
     * @test update
     */
    public function test_update_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $fakevendor_os = $this->fakevendor_osData();
        $updatedvendor_os = $this->vendorOsRepo->update($fakevendor_os, $vendorOs->id);
        $this->assertModelData($fakevendor_os, $updatedvendor_os->toArray());
        $dbvendor_os = $this->vendorOsRepo->find($vendorOs->id);
        $this->assertModelData($fakevendor_os, $dbvendor_os->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $resp = $this->vendorOsRepo->delete($vendorOs->id);
        $this->assertTrue($resp);
        $this->assertNull(vendor_os::find($vendorOs->id), 'vendor_os should not exist in DB');
    }
}
