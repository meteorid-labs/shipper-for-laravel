<?php

namespace Meteor\Shipper\Tests\Unit\Logistic;

use Illuminate\Support\Facades\Http;
use Meteor\Shipper\Api\Logistic\Logistic;
use Meteor\Shipper\Tests\TestCase;

class LogisticTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Logistic::class, $this->shipper->logistic());
    }

    /** @test */
    public function it_contains_the_correct_methods()
    {
        $this->assertTrue(method_exists(Logistic::class, '__construct'));
        $this->assertTrue(method_exists(Logistic::class, 'list'));
    }

    /** @test */
    public function it_can_get_logistic_list()
    {
        Http::fake([
            $this->shipper->getApiKey().'/v3/logistic' => $this->fakeResponse('logistic/list.json'),
        ]);

        $response = $this->shipper->logistic()->list()->json();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('metadata', $response);
        $this->assertArrayHasKey('data', $response);

        $this->assertIsArray($response['metadata']);
        $this->assertIsArray($response['data']);

        $this->assertEquals(200, $response['metadata']['http_status_code']);
        $this->assertEquals('Anteraja', $response['data'][0]['logistic']['name']);
    }
}
