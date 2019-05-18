<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makeos_docTrait;
use Tests\ApiTestTrait;

class os_docApiTest extends TestCase
{
    use Makeos_docTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_os_doc()
    {
        $osDoc = $this->fakeos_docData();
        $this->response = $this->json('POST', '/api/osDocs', $osDoc);

        $this->assertApiResponse($osDoc);
    }

    /**
     * @test
     */
    public function test_read_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $this->response = $this->json('GET', '/api/osDocs/'.$osDoc->id);

        $this->assertApiResponse($osDoc->toArray());
    }

    /**
     * @test
     */
    public function test_update_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $editedos_doc = $this->fakeos_docData();

        $this->response = $this->json('PUT', '/api/osDocs/'.$osDoc->id, $editedos_doc);

        $this->assertApiResponse($editedos_doc);
    }

    /**
     * @test
     */
    public function test_delete_os_doc()
    {
        $osDoc = $this->makeos_doc();
        $this->response = $this->json('DELETE', '/api/osDocs/'.$osDoc->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/osDocs/'.$osDoc->id);

        $this->response->assertStatus(404);
    }
}
