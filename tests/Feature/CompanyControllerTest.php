<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $data = Company::factory()->make()->toArray();

        $response = $this->post('/api/company/new', $data);

        $response->assertStatus(201)->assertJson([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function testView()
    {
        $data  = Company::factory()->make()->toArray();
        $model = Company::create($data);

        $response = $this->get('/api/company/' . $model->id);
        $response->assertStatus(200)->assertJson([
            'status' => true,
            'data'   => $data,
        ]);
    }

    public function testList()
    {
        Company::factory()->count(3)->create();

        $response = $this->get('/api/company/list');
        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data'));

        $response = $this->get('/api/company/list?offset=1&limit=2');
        $response->assertStatus(200);
        $this->assertCount(2, $response->json('data'));
    }

    public function testUpdate()
    {
        $model = Company::factory()->create();
        $data = Company::factory()->make()->toArray();

        $response = $this->put('/api/company/' . $model->id, $data);
        $response->assertStatus(200)->assertJson([
            'status' => true,
            'data'  => $data,
        ]);
    }

    public function testDelete()
    {
        $model = Company::factory()->create();

        $response = $this->delete('/api/company/'.$model->id);
        $response->assertStatus(204);

        $response = $this->get('/api/company/' . $model->id);
        $response->assertStatus(404);
    }
}
