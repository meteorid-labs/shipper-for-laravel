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

### Logistic

Create an instance of logistic:

```php
$logistic = $shipper->logistic();
```

##### List all logistic

```php
$logistic->list()->json();
```

### Location

Create an instance of location:

```php
$location = $shipper->location();
```

##### Search location

```php
$response = $location->search(
    keyword: '15510',
    admLevel: 5, // optional
    options: ['limit' => 5] // optional
)->json();
```

```php
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

### Pricing

Create an instance of pricing:

```php
$pricing = $shipper->pricing();
```

> Note: `lat` and `lng` must be in string format

```php
$domesticBody = [
    'cod' => false,
    'destination' => [
        'area_id' => 12284,
        'lat' => '-6.9189281',
        'lng' => '107.617093',
    ],
    'origin' => [
        'area_id' => 12441,
        'lat' => '-6.3179073',
        'lng' => '106.9506175'
    ],
    'for_order' => true,
    'height' => 6.54,
    'length' => 6.54,
    'width' => 6.54,
    'weight' => 0.18,
    'item_value' => 134950,
    'sort_by' => ['final_price']
];

$internationalBody = [];
```

##### Domestic

```php
$pricing->domestic(body: $domesticBody)->json();
```

##### Domestic by rate

Available rates:

- `instant`
- `regular`
- `express`
- `trucking`
- `same-day`

```php
$pricing->domesticByRate(rateType: 'instant', body: $domesticBody)->json();
```

##### International

```php
$pricing->international(body: $internationalBody)->json();
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
