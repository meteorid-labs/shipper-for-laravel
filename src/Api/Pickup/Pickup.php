<?php

namespace Meteor\Shipper\Api\Pickup;

use Meteor\Shipper\Shipper;

class Pickup
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
     * Create a Pickup Order.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function create(array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/pickup', $body);
    }

    /**
     * Cancel a Pickup Request.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function cancel(array $body)
    {
        return $this->shipper->getHttpClient()->patch('v3/pickup/cancel', $body);
    }

    /**
     * Create a Pickup Order V3 with Timeslot.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function createWithTimeslot(array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/pickup/timeslot', $body);
    }

    /**
     * Get list of pickup time slot
     *
     * @param  string  $timeZone Search by zone, default is Asia/Jakarta
     * @param  string  $requestTime search by request time ex.2021-08-09T06:28:00Z
     * @return \Illuminate\Http\Client\Response
     */
    public function getTimeSlot($timeZone = 'Asia/Jakarta', $requestTime = null)
    {
        return $this->shipper->getHttpClient()->get('v3/pickup/timeslot', [
            'time_zone' => $timeZone,
            'request_time' => $requestTime,
        ]);
    }
}
