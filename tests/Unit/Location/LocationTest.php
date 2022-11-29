<?php

namespace Meteor\Shipper\Tests\Unit\Location;

use Illuminate\Support\Facades\Http;
use Meteor\Shipper\Api\Location\Location;
use Meteor\Shipper\Tests\TestCase;

class LocationTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Location::class, $this->shipper->location());
    }

    /** @test */
    public function it_contains_the_correct_methods()
    {
        $this->assertTrue(method_exists(Location::class, '__construct'));
        $this->assertTrue(method_exists(Location::class, 'search'));
        $this->assertTrue(method_exists(Location::class, 'getCountries'));
        $this->assertTrue(method_exists(Location::class, 'getCountry'));
        $this->assertTrue(method_exists(Location::class, 'getProvinces'));
        $this->assertTrue(method_exists(Location::class, 'getProvince'));
        $this->assertTrue(method_exists(Location::class, 'getProvincesByCountryId'));
        $this->assertTrue(method_exists(Location::class, 'getCitiesByProvinceId'));
        $this->assertTrue(method_exists(Location::class, 'getCities'));
        $this->assertTrue(method_exists(Location::class, 'getCity'));
        $this->assertTrue(method_exists(Location::class, 'getSuburbs'));
        $this->assertTrue(method_exists(Location::class, 'getSuburbsByCityId'));
        $this->assertTrue(method_exists(Location::class, 'getSuburb'));
        $this->assertTrue(method_exists(Location::class, 'getAreasBySuburbId'));
        $this->assertTrue(method_exists(Location::class, 'getArea'));
        $this->assertTrue(method_exists(Location::class, 'getAreas'));
    }

    /** @test */
    public function it_can_search_for_locations()
    {
        Http::fake([
            $this->shipper->getApiUrl().'/v3/location?keyword=40112' => $this->fakeResponse('location/it_can_search_for_locations.json'),
        ]);

        $response = $this->shipper->location()->search('40112')->json();

        Http::assertSent(function ($request) {
            return $request->url() === $this->shipper->getApiUrl().'/v3/location?keyword=40112'
                && $request['keyword'] === '40112';
        });

        Http::assertSentCount(1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('metadata', $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('pagination', $response);

        $this->assertIsArray($response['metadata']);
        $this->assertIsArray($response['data']);
        $this->assertIsArray($response['pagination']);

        $this->assertEquals(200, $response['metadata']['http_status_code']);
        $this->assertCount(1, $response['data']);

        $this->assertArrayHasKey('adm_level_1', $response['data'][0]);
        $this->assertArrayHasKey('adm_level_2', $response['data'][0]);
        $this->assertArrayHasKey('adm_level_3', $response['data'][0]);
        $this->assertArrayHasKey('adm_level_4', $response['data'][0]);
        $this->assertArrayHasKey('adm_level_5', $response['data'][0]);
        $this->assertArrayHasKey('adm_level_cur', $response['data'][0]);
        $this->assertArrayHasKey('display_txt', $response['data'][0]);
        $this->assertArrayHasKey('postcodes', $response['data'][0]);

        $this->assertEquals('40112', $response['data'][0]['adm_level_cur']['postcode']);
    }

    /** @test */
    public function it_can_get_all_countries()
    {
        Http::fake([
            $this->shipper->getApiUrl().'/v3/location/countries?limit=30&page=1' => $this->fakeResponse('location/it_can_get_all_countries.json'),
        ]);

        $response = $this->shipper->location()->getCountries()->json();

        Http::assertSent(function ($request) {
            return $request->url() === $this->shipper->getApiUrl().'/v3/location/countries?limit=30&page=1'
                && $request['limit'] === 30
                && $request['page'] === 1;
        });

        Http::assertSentCount(1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('metadata', $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('pagination', $response);

        $this->assertIsArray($response['metadata']);
        $this->assertIsArray($response['data']);
        $this->assertIsArray($response['pagination']);

        $this->assertEquals(200, $response['metadata']['http_status_code']);
        $this->assertCount(30, $response['data']);
        $this->assertEquals('AFGHANISTAN', $response['data'][0]['name']);
    }

    /** @test */
    public function it_can_get_specific_countries()
    {
        Http::fake([
            $this->shipper->getApiUrl().'/v3/location/countries?country_id=228&limit=30&page=1' => $this->fakeResponse('location/it_can_get_specific_countries.json'),
        ]);

        $response = $this->shipper->location()->getCountries(228)->json();

        Http::assertSent(function ($request) {
            return $request->url() === $this->shipper->getApiUrl().'/v3/location/countries?country_id=228&limit=30&page=1'
                && $request['country_id'] === 228;
        });

        Http::assertSentCount(1);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('metadata', $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('pagination', $response);

        $this->assertIsArray($response['metadata']);
        $this->assertIsArray($response['data']);
        $this->assertIsArray($response['pagination']);

        $this->assertEquals(200, $response['metadata']['http_status_code']);
        $this->assertCount(1, $response['data']);
        $this->assertEquals('INDONESIA', $response['data'][0]['name']);
    }
}
