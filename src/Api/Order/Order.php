<?php

namespace Meteor\Shipper\Api\Order;

use Meteor\Shipper\Shipper;

class Order
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
     * Create order.
     *
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function create(array $body)
    {
        return $this->shipper->getHttpClient()->post('v3/order', $body);
    }

    /**
     * Get Order Detail by Order ID.
     *
     * @param  string  $orderId Shipper's Order ID, Example: 208ABCDEFGH
     * @return \Illuminate\Http\Client\Response
     */
    public function detail($orderId)
    {
        return $this->shipper->getHttpClient()->get('v3/order/'.$orderId);
    }

    /**
     * Get order tracking status by Status ID.
     *
     * @param  string  $statusId Status ID
     * @return \Illuminate\Http\Client\Response
     */
    public function trackingStatus($statusId)
    {
        return $this->shipper->getHttpClient()->get('v3/order/status/'.$statusId);
    }

    /**
     * Get available orders by params.
     *
     * @param  string  $dateStart Order Creation Date Start (Format: YYYY-MM-DD), Example: 2020-08-17
     * @param  string  $dateEnd Order Creation Date End (Format: YYYY-MM-DD), Example: 2020-08-17
     * @param  int[]  $orderStatusId Array of Shipper's Order Status ID, Example: 1000, 1001, 1002
     * @param  string  $sortBy Sort By, Example: created_date (ascending), -created_date (descending)
     * @param  int  $page Page Number, Example: 1
     * @param  int  $limit Limit, Example: 10
     * @return \Illuminate\Http\Client\Response
     */
    public function availableOrders($dateStart, $dateEnd, $orderStatusId, $sortBy, $page, $limit)
    {
        return $this->shipper->getHttpClient()->get('v3/order', [
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'order_status_id' => $orderStatusId,
            'sort_by' => $sortBy,
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Update Selected Order.
     *
     * @param  string  $orderId Shipper's Order ID, Example: 208ABCDEFGH
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function update($orderId, array $body)
    {
        return $this->shipper->getHttpClient()->put('v3/order/'.$orderId, $body);
    }

    /**
     * Cancel Order by OrderID.
     * If the order is an instant courier direct (GOSEND, Grab Direct) order, Calling this Cancel API will attempt to cancel the GOSEND/Grab booking first.
     * If the booking cancelation is failed, the cancelation will fail.
     * If customer already requested a pickup with Pickup API /v3/pickup it will dettach the order from the pickup, If the order is the only order left, the pickup will be cancelled.
     *
     * @param  string  $orderId Shipper's Order ID, Example: 208ABCDEFGH
     * @param  array  $body
     * @return \Illuminate\Http\Client\Response
     */
    public function cancel($orderId, array $body)
    {
        return $this->shipper->getHttpClient()->patch('v3/order/'.$orderId, $body);
    }
}
