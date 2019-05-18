<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakefungsiTrait;
use Tests\ApiTestTrait;

class fungsiApiTest extends TestCase
{
    use MakefungsiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_fungsi()
    {
        $fungsi = $this->fakefungsiData();
        $this->response = $this->json('POST', '/api/fungsis', $fungsi);

        $this->assertApiResponse($fungsi);
    }

    /**
     * @test
     */
    public function test_read_fungsi()
    {
        $fungsi = $this->makefungsi();
        $this->response = $this->json('GET', '/api/fungsis/'.$fungsi->id);

        $this->assertApiResponse($fungsi->toArray());
    }

    /**
     * @test
     */
    public function test_update_fungsi()
    {
        $fungsi = $this->makefungsi();
        $editedfungsi = $this->fakefungsiData();

        $this->response = $this->json('PUT', '/api/fungsis/'.$fungsi->id, $editedfungsi);

        $this->assertApiResponse($editedfungsi);
    }

    /**
     * @test
     */
    public function test_delete_fungsi()
    {
        $fungsi = $this->makefungsi();
        $this->response = $this->json('DELETE', '/api/fungsis/'.$fungsi->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/fungsis/'.$fungsi->id);

        $this->response->assertStatus(404);
    }
}
