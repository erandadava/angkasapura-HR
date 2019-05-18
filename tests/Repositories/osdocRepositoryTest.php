<?php namespace Tests\Repositories;

use App\Models\osdoc;
use App\Repositories\osdocRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeosdocTrait;
use Tests\ApiTestTrait;

class osdocRepositoryTest extends TestCase
{
    use MakeosdocTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var osdocRepository
     */
    protected $osdocRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->osdocRepo = \App::make(osdocRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_osdoc()
    {
        $osdoc = $this->fakeosdocData();
        $createdosdoc = $this->osdocRepo->create($osdoc);
        $createdosdoc = $createdosdoc->toArray();
        $this->assertArrayHasKey('id', $createdosdoc);
        $this->assertNotNull($createdosdoc['id'], 'Created osdoc must have id specified');
        $this->assertNotNull(osdoc::find($createdosdoc['id']), 'osdoc with given id must be in DB');
        $this->assertModelData($osdoc, $createdosdoc);
    }

    /**
     * @test read
     */
    public function test_read_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $dbosdoc = $this->osdocRepo->find($osdoc->id);
        $dbosdoc = $dbosdoc->toArray();
        $this->assertModelData($osdoc->toArray(), $dbosdoc);
    }

    /**
     * @test update
     */
    public function test_update_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $fakeosdoc = $this->fakeosdocData();
        $updatedosdoc = $this->osdocRepo->update($fakeosdoc, $osdoc->id);
        $this->assertModelData($fakeosdoc, $updatedosdoc->toArray());
        $dbosdoc = $this->osdocRepo->find($osdoc->id);
        $this->assertModelData($fakeosdoc, $dbosdoc->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $resp = $this->osdocRepo->delete($osdoc->id);
        $this->assertTrue($resp);
        $this->assertNull(osdoc::find($osdoc->id), 'osdoc should not exist in DB');
    }
}
