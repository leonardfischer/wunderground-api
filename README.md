# Weather Underground API Client

This library shall help you integrate the WeatherUnderground API to your webservice.
It is extremely lightweight and provides all necessary code.

## Code Example

Using the API is very easy - you'll only need to provide a API key (Get one [here](https://www.wunderground.com/weather/api/)) in order to use it. There are functions for retrieving different weather data by predefined conditions, like "by country and city", "by latitude and longitude", "by airport code" or even "by IP address".

```php
// By default the current conditions will be requested in english language.
$weather = (new \lfischer\wunderground\API('<API-key here>'))->getByLocation('Germany', 'Dusseldorf');
```


## Run tests
Install the dependencies:
```sh
composer install
```
and run the tests:

```sh
./vendor/bin/phpunit
```
Uncommenting the `<logging>` element of `phpunit.xml` configuration file will generate the coverage html file
when the tests are run.


## Future to-dos / nice-to-have

At some point I'd like to improve this client to be as readable as possible. For example:

```php
use lfischer\wunderground;
 
$weather = (new API('<API-key here>'))
    ->getConditions()
    ->byLocation('Germany', 'Dusseldorf')
    ->fetch()
    ->asArray();
```

## Contributors

 - **Leonard Fischer** - initial programming [Github profile](https://github.com/leonardfischer)
 - **Stefano Borghi** - writing tests and improving code [Github profile](https://github.com/stebogit)