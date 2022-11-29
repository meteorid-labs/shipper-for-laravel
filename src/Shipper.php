<?php

namespace Meteor\Shipper;

use Illuminate\Support\Facades\Http;

class Shipper
{
    /**
     * Create a new Shipper instance.
     *
     * @param  string  $apiKey
     * @param  string  $apiUrl
     * @return void
     */
    public function __construct(
        protected $apiKey = null,
        protected $apiUrl = null,
    ) {
        $this->apiKey = $apiKey ?? config('meteor.shipper.api_key');
        $this->apiUrl = $apiUrl ?? 'https://merchant-api.shipper.id';
    }

    /**
     * Make a client.
     *
     * @param  ?string  $url
     * @return static
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }

    /**
     * Get the api url.
     *
     * @return string
     */
    final public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Get API Key.
     *
     * @return string
     */
    final public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set API Key.
     *
     * @param  string  $apiKey
     * @return $this
     */
    final public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Use sandbox environment.
     *
     * @return $this
     */
    final public function useSandbox()
    {
        $this->apiUrl = 'https://merchant-api-sandbox.shipper.id';

        return $this;
    }

    /**
     * Use production environment.
     *
     * @return $this
     */
    final public function useProduction()
    {
        $this->apiUrl = 'https://merchant-api.shipper.id';

        return $this;
    }

    /**
     * The http client.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function getHttpClient()
    {
        return Http::withHeaders([
            'X-API-Key' => $this->getApiKey(),
            'Accept' => 'application/json',
        ])->baseUrl($this->getApiUrl());
    }

    /**
     * The magic method.
     *
     * @param  string  $name
     * @param  mixed  $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = __NAMESPACE__.'\\Api\\'.ucfirst($name).'\\'.ucfirst($name);

        if (class_exists($class)) {
            return new $class($this);
        }

        throw new \Exception("Class {$class} not found");
    }
}
