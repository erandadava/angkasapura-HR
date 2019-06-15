<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeOsperformanceTrait;
use Tests\ApiTestTrait;

class OsperformanceApiTest extends TestCase
{
    use MakeOsperformanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_osperformance()
    {
        $osperformance = $this->fakeOsperformanceData();
        $this->response = $this->json('POST', '/api/osperformances', $osperformance);

        $this->assertApiResponse($osperformance);
    }

    /**
     * @test
     */
    public function test_read_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $this->response = $this->json('GET', '/api/osperformances/'.$osperformance->id);

        $this->assertApiResponse($osperformance->toArray());
    }

    /**
     * @test
     */
    public function test_update_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $editedOsperformance = $this->fakeOsperformanceData();

        $this->response = $this->json('PUT', '/api/osperformances/'.$osperformance->id, $editedOsperformance);

        $this->assertApiResponse($editedOsperformance);
    }

    /**
     * @test
     */
    public function test_delete_osperformance()
    {
        $osperformance = $this->makeOsperformance();
        $this->response = $this->json('DELETE', '/api/osperformances/'.$osperformance->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/osperformances/'.$osperformance->id);

        $this->response->assertStatus(404);
    }
}
