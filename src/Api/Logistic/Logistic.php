<?php

namespace Meteor\Shipper\Api\Logistic;

use Meteor\Shipper\Shipper;

class Logistic
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
     * Get logistic list.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function list()
    {
        return $this->shipper->getHttpClient()->get('v3/logistic');
    }
}
