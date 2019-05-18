<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakestatuskarTrait;
use Tests\ApiTestTrait;

class statuskarApiTest extends TestCase
{
    use MakestatuskarTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_statuskar()
    {
        $statuskar = $this->fakestatuskarData();
        $this->response = $this->json('POST', '/api/statuskars', $statuskar);

        $this->assertApiResponse($statuskar);
    }

    /**
     * @test
     */
    public function test_read_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $this->response = $this->json('GET', '/api/statuskars/'.$statuskar->id);

        $this->assertApiResponse($statuskar->toArray());
    }

    /**
     * @test
     */
    public function test_update_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $editedstatuskar = $this->fakestatuskarData();

        $this->response = $this->json('PUT', '/api/statuskars/'.$statuskar->id, $editedstatuskar);

        $this->assertApiResponse($editedstatuskar);
    }

    /**
     * @test
     */
    public function test_delete_statuskar()
    {
        $statuskar = $this->makestatuskar();
        $this->response = $this->json('DELETE', '/api/statuskars/'.$statuskar->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/statuskars/'.$statuskar->id);

        $this->response->assertStatus(404);
    }
}
