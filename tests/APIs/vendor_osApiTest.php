<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Makevendor_osTrait;
use Tests\ApiTestTrait;

class vendor_osApiTest extends TestCase
{
    use Makevendor_osTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_vendor_os()
    {
        $vendorOs = $this->fakevendor_osData();
        $this->response = $this->json('POST', '/api/vendorOs', $vendorOs);

        $this->assertApiResponse($vendorOs);
    }

    /**
     * @test
     */
    public function test_read_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $this->response = $this->json('GET', '/api/vendorOs/'.$vendorOs->id);

        $this->assertApiResponse($vendorOs->toArray());
    }

    /**
     * @test
     */
    public function test_update_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $editedvendor_os = $this->fakevendor_osData();

        $this->response = $this->json('PUT', '/api/vendorOs/'.$vendorOs->id, $editedvendor_os);

        $this->assertApiResponse($editedvendor_os);
    }

    /**
     * @test
     */
    public function test_delete_vendor_os()
    {
        $vendorOs = $this->makevendor_os();
        $this->response = $this->json('DELETE', '/api/vendorOs/'.$vendorOs->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/vendorOs/'.$vendorOs->id);

        $this->response->assertStatus(404);
    }
}
