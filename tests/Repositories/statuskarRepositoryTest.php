<?php namespace Tests\Repositories;

use App\Models\statuskar;
use App\Repositories\statuskarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakestatuskarTrait;
use Tests\ApiTestTrait;

class statuskarRepositoryTest extends TestCase
{
    use MakestatuskarTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var statuskarRepository
     */
    protected $statuskarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->statuskarRepo = \App::make(statuskarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_statuskar()
    {
        $statuskar = $this->fakestatuskarData();
        $createdstatuskar = $this->statuskarRepo->create($statuskar);
        $createdstatuskar = $createdstatuskar->toArray();
        $this->assertArrayHasKey('id', $createdstatuskar);
        $this->assertNotNull($createdstatuskar['id'], 'Created statuskar must have id specified');
        $this->assertNotNull(statuskar::find($createdstatuskar['id']), 'statuskar with given id must be in DB');
        $this->assertModelData($statuskar, $createdstatuskar);
    }

    /**
     * @test read
     */
    public function test_read_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $dbstatuskar = $this->statuskarRepo->find($statuskar->id);
        $dbstatuskar = $dbstatuskar->toArray();
        $this->assertModelData($statuskar->toArray(), $dbstatuskar);
    }

    /**
     * @test update
     */
    public function test_update_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $fakestatuskar = $this->fakestatuskarData();
        $updatedstatuskar = $this->statuskarRepo->update($fakestatuskar, $statuskar->id);
        $this->assertModelData($fakestatuskar, $updatedstatuskar->toArray());
        $dbstatuskar = $this->statuskarRepo->find($statuskar->id);
        $this->assertModelData($fakestatuskar, $dbstatuskar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $resp = $this->statuskarRepo->delete($statuskar->id);
        $this->assertTrue($resp);
        $this->assertNull(statuskar::find($statuskar->id), 'statuskar should not exist in DB');
    }
}
