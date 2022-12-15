<?php

declare(strict_types=1);

namespace Meteor\Shipper\Api\Location;

use Meteor\Shipper\Shipper;

class Location
{
    /**
     * Create a new LocationApi instance.
     *
     * @param  string  $config
     * @return void
     */
    public function __construct(
        protected Shipper $shipper,
    ) {
    }

    /**
     * Search for a location using a keyword and optional administrative level.
     *
     * @param  string  $keyword
     * @param  int|null  $admLevel
     * @param  array  $options
     * @return \Illuminate\Http\Client\Response
     */
    public function search($keyword, $admLevel = null, $options = [])
    {
        return $this->shipper->getHttpClient()->get('v3/location', [
            'adm_level' => $admLevel,
            'keyword' => $keyword,
            ...$options,
        ]);
    }

    /**
     * Get country list.
     *
     * @param  int  $countryId Shipper’s Country ID integer
     * @param  int  $limit Limit data for each page, integer example:30 (default: 30)
     * @param  int  $page Page Number integer example: 1 (default: 1)
     * @return \Illuminate\Http\Client\Response
     */
    public function getCountries($countryId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/countries', [
            'country_id' => $countryId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get country by country id.
     *
     * @param  int  $countryId Shipper’s Country ID integer example:228
     * @return \Illuminate\Http\Client\Response
     */
    public function getCountry($countryId)
    {
        return $this->shipper->getHttpClient()->get('v3/location/country/'.$countryId);
    }

    /**
     * Get provinces.
     *
     * @param  int  $countryId
     * @param  int  $provinceId
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getProvinces($countryId = 228, $provinceId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/provinces', [
            'country_id' => $countryId,
            'province_id' => $provinceId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get provinces by id.
     *
     * @param  int  $provinceId
     * @return \Illuminate\Http\Client\Response
     */
    public function getProvince($provinceId)
    {
        return $this->shipper->getHttpClient()->get('v3/location/province/'.$provinceId);
    }

    /**
     * Get provinces by country id.
     *
     * * Path parameters:
     *
     * @param  int  $countryId
     *
     * * Query parameters:
     * @param  int  $provinceId
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getProvincesByCountryId($countryId, $provinceId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/country/'.$countryId.'/provinces', [
            'province_id' => $provinceId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get cities by province id.
     *
     * * Path parameters:
     *
     * @param  int  $provinceId
     *
     * * Query parameters:
     * @param  int  $cityId
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getCitiesByProvinceId($provinceId, $cityId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/province/'.$provinceId.'/cities', [
            'city_id' => $cityId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get cities.
     *
     * @param  string[]  $cityIds
     * @param  int  $provinceId
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getCities(array $cityIds = [], $provinceId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/cities', [
            'city_ids' => $cityIds,
            'province_id' => $provinceId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get city by id.
     *
     * @param  int  $cityId
     * @return \Illuminate\Http\Client\Response
     */
    public function getCity($cityId)
    {
        return $this->shipper->getHttpClient()->get('v3/location/city/'.$cityId);
    }

    /**
     * Get suburbs.
     *
     * @param  int  $cityId
     * @param  string[]  $suburbIds
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getSuburbs($cityId = null, array $suburbIds = [], $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/suburbs', [
            'city_id' => $cityId,
            'suburb_ids' => $suburbIds,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get suburb by city id.
     *
     * * Path parameters:
     *
     * @param  int  $cityId
     *
     * * Query parameters:
     * @param  string[]  $suburbIds
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getSuburbsByCityId($cityId, array $suburbIds = [], $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/city/'.$cityId.'/suburbs', [
            'suburb_ids' => $suburbIds,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get suburb by id.
     *
     * @param  int  $suburbId
     * @return \Illuminate\Http\Client\Response
     */
    public function getSuburb($suburbId)
    {
        return $this->shipper->getHttpClient()->get('v3/location/suburb/'.$suburbId);
    }

    /**
     * Get areas by suburb id.
     *
     * * Path parameters:
     *
     * @param  int  $suburbId
     *
     * * Query parameters:
     * @param  string[]  $areaIds
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getAreasBySuburbId($suburbId, array $areaIds = [], $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/suburb/'.$suburbId.'/areas', [
            'area_ids' => $areaIds,
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get area by area id.
     *
     * @param  int  $areaId
     * @return \Illuminate\Http\Client\Response
     */
    public function getArea($areaId)
    {
        return $this->shipper->getHttpClient()->get('v3/location/area/'.$areaId);
    }

    /**
     * Get areas.
     *
     * @param  string[]  $areaIds
     * @param  int  $suburbId
     * @param  int  $limit
     * @param  int  $page
     * @return \Illuminate\Http\Client\Response
     */
    public function getAreas(array $areaIds = [], $suburbId = null, $limit = 30, $page = 1)
    {
        return $this->shipper->getHttpClient()->get('v3/location/areas', [
            'area_ids' => $areaIds,
            'suburb_id' => $suburbId,
            'limit' => $limit,
            'page' => $page,
        ]);
    }
}
