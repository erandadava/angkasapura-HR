<?php namespace Tests\Repositories;

use App\Models\os_doc;
use App\Repositories\os_docRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makeos_docTrait;
use Tests\ApiTestTrait;

class os_docRepositoryTest extends TestCase
{
    use Makeos_docTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var os_docRepository
     */
    protected $osDocRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->osDocRepo = \App::make(os_docRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_os_doc()
    {
        $osDoc = $this->fakeos_docData();
        $createdos_doc = $this->osDocRepo->create($osDoc);
        $createdos_doc = $createdos_doc->toArray();
        $this->assertArrayHasKey('id', $createdos_doc);
        $this->assertNotNull($createdos_doc['id'], 'Created os_doc must have id specified');
        $this->assertNotNull(os_doc::find($createdos_doc['id']), 'os_doc with given id must be in DB');
        $this->assertModelData($osDoc, $createdos_doc);
    }

    /**
     * @test read
     */
    public function test_read_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $dbos_doc = $this->osDocRepo->find($osDoc->id);
        $dbos_doc = $dbos_doc->toArray();
        $this->assertModelData($osDoc->toArray(), $dbos_doc);
    }

    /**
     * @test update
     */
    public function test_update_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $fakeos_doc = $this->fakeos_docData();
        $updatedos_doc = $this->osDocRepo->update($fakeos_doc, $osDoc->id);
        $this->assertModelData($fakeos_doc, $updatedos_doc->toArray());
        $dbos_doc = $this->osDocRepo->find($osDoc->id);
        $this->assertModelData($fakeos_doc, $dbos_doc->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $resp = $this->osDocRepo->delete($osDoc->id);
        $this->assertTrue($resp);
        $this->assertNull(os_doc::find($osDoc->id), 'os_doc should not exist in DB');
    }
}
