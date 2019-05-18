<?php namespace Tests\Repositories;

use App\Models\tipekar;
use App\Repositories\tipekarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MaketipekarTrait;
use Tests\ApiTestTrait;

class tipekarRepositoryTest extends TestCase
{
    use MaketipekarTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var tipekarRepository
     */
    protected $tipekarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipekarRepo = \App::make(tipekarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipekar()
    {
        $tipekar = $this->faketipekarData();
        $createdtipekar = $this->tipekarRepo->create($tipekar);
        $createdtipekar = $createdtipekar->toArray();
        $this->assertArrayHasKey('id', $createdtipekar);
        $this->assertNotNull($createdtipekar['id'], 'Created tipekar must have id specified');
        $this->assertNotNull(tipekar::find($createdtipekar['id']), 'tipekar with given id must be in DB');
        $this->assertModelData($tipekar, $createdtipekar);
    }

    /**
     * @test read
     */
    public function test_read_tipekar()
    {
        $tipekar = $this->maketipekar();
        $dbtipekar = $this->tipekarRepo->find($tipekar->id);
        $dbtipekar = $dbtipekar->toArray();
        $this->assertModelData($tipekar->toArray(), $dbtipekar);
    }

    /**
     * @test update
     */
    public function test_update_tipekar()
    {
        $tipekar = $this->maketipekar();
        $faketipekar = $this->faketipekarData();
        $updatedtipekar = $this->tipekarRepo->update($faketipekar, $tipekar->id);
        $this->assertModelData($faketipekar, $updatedtipekar->toArray());
        $dbtipekar = $this->tipekarRepo->find($tipekar->id);
        $this->assertModelData($faketipekar, $dbtipekar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipekar()
    {
        $tipekar = $this->maketipekar();
        $resp = $this->tipekarRepo->delete($tipekar->id);
        $this->assertTrue($resp);
        $this->assertNull(tipekar::find($tipekar->id), 'tipekar should not exist in DB');
    }
}
