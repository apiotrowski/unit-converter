# Unit Converter

[![Build Status](https://travis-ci.org/apiotrowski/unit-converter.svg?branch=master)](https://travis-ci.org/apiotrowski/unit-converter)

Unit converter it is php service which converts values based on raw string query.

> QueryExample: 10cm to ?in 

Converter will automatically resolve supported converter and make calculation. In the output it return new **Value**.
 
**Value** is an Object what have two property: _Value_ (string), _Unit_ (object).

## Current list of converters:
* Length Converter (unit: cm, in, ft)

## How to use it

Unit Converter is really simple to use and easy to extend. In a bellow example I show how to use this tool.

```php
$convertManager = new ConvertManager([ \UnitConverter\Converter\LengthConverter ]);
$convertedValue = $convertManager->convert('10cm to ?in');

```

In the $convertedValue it is calculated Value based on raw query string. To calculating values tool is use [BC Math library](http://php.net/manual/en/ref.bc.php). 
 
Tool are tested in PHPUnit, so everything should work properly.

## How to extend Unit Converter

To Extend Converter User should:
 
1. Add new Converter Class what implement Converter Interface.

2. Add new Converter Class in the UnitFactory class.

3. During initializing ConvertManager put new Class as argument in convertClassList.

## Supported PHP Versions
* PHP 7.0 with installed BC Math Extension