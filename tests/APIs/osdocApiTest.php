<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeosdocTrait;
use Tests\ApiTestTrait;

class osdocApiTest extends TestCase
{
    use MakeosdocTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_osdoc()
    {
        $osdoc = $this->fakeosdocData();
        $this->response = $this->json('POST', '/api/osdocs', $osdoc);

        $this->assertApiResponse($osdoc);
    }

    /**
     * @test
     */
    public function test_read_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $this->response = $this->json('GET', '/api/osdocs/'.$osdoc->id);

        $this->assertApiResponse($osdoc->toArray());
    }

    /**
     * @test
     */
    public function test_update_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $editedosdoc = $this->fakeosdocData();

        $this->response = $this->json('PUT', '/api/osdocs/'.$osdoc->id, $editedosdoc);

        $this->assertApiResponse($editedosdoc);
    }

    /**
     * @test
     */
    public function test_delete_osdoc()
    {
        $osdoc = $this->makeosdoc();
        $this->response = $this->json('DELETE', '/api/osdocs/'.$osdoc->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/osdocs/'.$osdoc->id);

        $this->response->assertStatus(404);
    }
}
