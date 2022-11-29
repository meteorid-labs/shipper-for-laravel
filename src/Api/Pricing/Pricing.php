<?php

namespace Meteor\Shipper\Api\Pricing;

use Meteor\Shipper\Shipper;

class Pricing
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
     * Get domestic pricing.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function domestic(array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/pricing/domestic', $body);
    }

    /**
     * Get domestic pricing by rate type.
     *
     * * Path parameters:
     *
     * @param  string  $rateType
     *
     * * Body parameters:
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function domesticByRate($rateType, array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/pricing/domestic/'.$rateType, $body);
    }

    /**
     * Get international pricing.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function international(array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/pricing/international', $body);
    }
}
