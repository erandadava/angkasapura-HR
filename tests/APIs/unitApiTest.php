<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeunitTrait;
use Tests\ApiTestTrait;

class unitApiTest extends TestCase
{
    use MakeunitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unit()
    {
        $unit = $this->fakeunitData();
        $this->response = $this->json('POST', '/api/units', $unit);

        $this->assertApiResponse($unit);
    }

    /**
     * @test
     */
    public function test_read_unit()
    {
        $unit = $this->makeunit();
        $this->response = $this->json('GET', '/api/units/'.$unit->id);

        $this->assertApiResponse($unit->toArray());
    }

    /**
     * @test
     */
    public function test_update_unit()
    {
        $unit = $this->makeunit();
        $editedunit = $this->fakeunitData();

        $this->response = $this->json('PUT', '/api/units/'.$unit->id, $editedunit);

        $this->assertApiResponse($editedunit);
    }

    /**
     * @test
     */
    public function test_delete_unit()
    {
        $unit = $this->makeunit();
        $this->response = $this->json('DELETE', '/api/units/'.$unit->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/units/'.$unit->id);

        $this->response->assertStatus(404);
    }
}
