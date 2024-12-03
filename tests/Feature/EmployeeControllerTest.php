<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $data = Employee::factory()->make()->toArray();

        $response = $this->post('/api/employee/new', $data);

        $response->assertStatus(201)->assertJson([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function testView()
    {
        $data  = Employee::factory()->make()->toArray();
        $model = Employee::create($data);

        $response = $this->get('/api/employee/' . $model->id);
        $response->assertStatus(200)->assertJson([
            'status' => true,
            'data'   => $data,
        ]);
    }

    public function testList()
    {
        Employee::factory()->count(3)->create();

        $response = $this->get('/api/employee/list');
        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data'));

        $response = $this->get('/api/employee/list?offset=1&limit=2');
        $response->assertStatus(200);
        $this->assertCount(2, $response->json('data'));
    }

    public function testUpdate()
    {
        $model = Employee::factory()->create();
        $data = Employee::factory()->make()->toArray();

        $response = $this->put('/api/employee/' . $model->id, $data);
        $response->assertStatus(200)->assertJson([
            'status' => true,
            'data'  => $data,
        ]);
    }

    public function testDelete()
    {
        $model = Employee::factory()->create();

        $response = $this->delete('/api/employee/'.$model->id);
        $response->assertStatus(204);

        $response = $this->get('/api/employee/' . $model->id);
        $response->assertStatus(404);
    }

    public function testEmployees()
    {
        $company = Company::factory()->create();
        Employee::factory()
                ->count(3)
                ->create(['company_id' => $company->id]);

        $response = $this->get('/api/employee/company/' . $company->id);
        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data'));
    }
}
