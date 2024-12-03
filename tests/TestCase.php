<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    /**
     * Get formatted resource data
     *
     * @param JsonResource $resource
     * @return array
     */
    protected function getResourceData(JsonResource $resource)
    {
        return $resource->withoutWrapper()->response()->getData(true);
    }
}