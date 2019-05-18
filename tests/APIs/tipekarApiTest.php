<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MaketipekarTrait;
use Tests\ApiTestTrait;

class tipekarApiTest extends TestCase
{
    use MaketipekarTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipekar()
    {
        $tipekar = $this->faketipekarData();
        $this->response = $this->json('POST', '/api/tipekars', $tipekar);

        $this->assertApiResponse($tipekar);
    }

    /**
     * @test
     */
    public function test_read_tipekar()
    {
        $tipekar = $this->maketipekar();
        $this->response = $this->json('GET', '/api/tipekars/'.$tipekar->id);

        $this->assertApiResponse($tipekar->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipekar()
    {
        $tipekar = $this->maketipekar();
        $editedtipekar = $this->faketipekarData();

        $this->response = $this->json('PUT', '/api/tipekars/'.$tipekar->id, $editedtipekar);

        $this->assertApiResponse($editedtipekar);
    }

    /**
     * @test
     */
    public function test_delete_tipekar()
    {
        $tipekar = $this->maketipekar();
        $this->response = $this->json('DELETE', '/api/tipekars/'.$tipekar->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/tipekars/'.$tipekar->id);

        $this->response->assertStatus(404);
    }
}
