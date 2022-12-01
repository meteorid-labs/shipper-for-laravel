# Shipper for Laravel

[![Shipper tests](https://github.com/meteorid-labs/laravel-shipper/actions/workflows/tests.yml/badge.svg)](https://github.com/meteorid-labs/laravel-shipper/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/meteor/shipper/v/stable)](https://packagist.org/packages/meteor/shipper)
[![Total Downloads](https://poser.pugx.org/meteor/shipper/downloads)](https://packagist.org/packages/meteor/shipper)
[![License](https://poser.pugx.org/meteor/shipper/license)](https://packagist.org/packages/meteor/shipper)

Laravel Shipper is a wrapper around the [Shipper](https://shipper.id) API.

## Installation

You can install the package via composer:

```bash
composer require meteor/shipper
```

## Publishing the config file

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Meteor\Shipper\ShipperServiceProvider" --tag="meteor.shipper.config"
```

### Configuration

Before you can use the Shipper API, you need to set your API key. You can do this by setting the `SHIPPER_API_KEY` environment variable in your `.env` file. if you don't have an API key, you can get one from [here](https://shipper.id).

```dotenv
SHIPPER_API_KEY=your-api-key
```

### Usage

To initialize the Shipper API, you can use the `Shipper` facade.

```php
use Meteor\Shipper\Facades\Shipper;

$shipper = Shipper::make();
```

`make()` accepts two optional parameters: `baseUrl` and `apiKey`. If you don't pass any parameters, it will use the `SHIPPER_API_KEY` environment variable.

```php
$shipper = Shipper::make('your-api-key', 'https://api.shipper.id');
```

#### Available methods

##### Locations

```php
$location = $shipper->location();

$location->search('40112')->json();
$location->getCountries()->json();
$location->getCountry()->json();
$location->getProvinces()->json();
$location->getProvince()->json();
$location->getProvincesByCountryId()->json();
$location->getCitiesByProvinceId()->json();
$location->getCities()->json();
$location->getCity()->json();
$location->getSuburbs()->json();
$location->getSuburbsByCityId()->json();
$location->getSuburb()->json();
$location->getAreasBySuburbId()->json();
$location->getAreas()->json();
$location->getArea()->json();
```

##### Logistics

```php
$logistic = $shipper->logistic();

$logistic->list()->json();
```

##### Order

```php
$order = $shipper->order();

$order->create([])->json();
$order->detail('order-id')->json();
$order->trackingStatus('status-id')->json();
$order->availableOrders()->json();
$order->update('order-id', [])->json();
$order->cancel('order-id', [])->json();
```

##### Pickup

```php
$pickup = $shipper->pickup();

$pickup->create([])->json();
$pickup->cancel([])->json();
$pickup->createWithTimeslot([])->json();
$pickup->getTimeSlots()->json();
```

##### Pricing

```php
$pricing = $shipper->pricing();

$pricing->domestic([])->json();
$pricing->domesticByRate('rate', [])->json();
$pricing->international([])->json();
```
