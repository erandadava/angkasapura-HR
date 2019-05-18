<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeunitkerjaTrait;
use Tests\ApiTestTrait;

class unitkerjaApiTest extends TestCase
{
    use MakeunitkerjaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unitkerja()
    {
        $unitkerja = $this->fakeunitkerjaData();
        $this->response = $this->json('POST', '/api/unitkerjas', $unitkerja);

        $this->assertApiResponse($unitkerja);
    }

    /**
     * @test
     */
    public function test_read_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $this->response = $this->json('GET', '/api/unitkerjas/'.$unitkerja->id);

        $this->assertApiResponse($unitkerja->toArray());
    }

    /**
     * @test
     */
    public function test_update_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $editedunitkerja = $this->fakeunitkerjaData();

        $this->response = $this->json('PUT', '/api/unitkerjas/'.$unitkerja->id, $editedunitkerja);

        $this->assertApiResponse($editedunitkerja);
    }

    /**
     * @test
     */
    public function test_delete_unitkerja()
    {
        $unitkerja = $this->makeunitkerja();
        $this->response = $this->json('DELETE', '/api/unitkerjas/'.$unitkerja->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/unitkerjas/'.$unitkerja->id);

        $this->response->assertStatus(404);
    }
}
