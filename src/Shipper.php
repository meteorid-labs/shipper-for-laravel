<?php

namespace Meteor\Shipper;

use Illuminate\Support\Facades\Http;

class Shipper
{
    /**
     * Indicates if Passport migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * Create a new Meteor Shipper client instance.
     *
     * @param  string|null  $apiKey
     * @param  string|null  $apiUrl
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
     * Configure Shipper to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Create a new instance of the class.
     *
     * @param  mixed  ...$args
     * @return static
     */
    public static function make(...$args)
    {
        return new static(...$args);
    }

    /**
     * Get the API URL being used for requests.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Get the API key being used for requests.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the API key to use for requests.
     *
     * @param  string  $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Use the sandbox API URL.
     *
     * @return $this
     */
    public function useSandbox()
    {
        $this->apiUrl = 'https://merchant-api-sandbox.shipper.id';

        return $this;
    }

    /**
     * Use the production API URL.
     *
     * @return $this
     */
    public function useProduction()
    {
        $this->apiUrl = 'https://merchant-api.shipper.id';

        return $this;
    }

    /**
     * Get an HTTP client instance with the API key and URL set.
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
     * Dynamically call an API class.
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return \Pterodactyl\Contracts\Api\ApiInterface
     *
     * @throws \Exception
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
