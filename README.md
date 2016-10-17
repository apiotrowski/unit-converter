# Unit Converter

[![Build Status](https://travis-ci.org/apiotrowski/unit-converter.svg?branch=master)](https://travis-ci.org/apiotrowski/unit-converter)

Unit converter it is php service which converts values based on raw string query.

> QueryExample: 10cm to ?in 

Converter will automatically resolve supported converter and make calculation. In the output it return new **Value**.
 
**Value** is an Object what have two property: _Value_ (string), _Unit_ (object).

## Manual conversion

If you want to convert values not using Convert Manager you can do it directly by calling following snippet:

```php
(new LengthConverter())->convertTo(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH));
```

## Current list of supported converters:
* Length Converter (unit: ml, km, m, cm, in, ft)
* Weight Converter (unit: t, kg, g, dag, lbs, oz)

## How to use it

Unit Converter is really simple to use and easy to extend. In a bellow example I show how to use this tool. 

```php
$convertManager = new ConvertManager([ LengthConverter::class, WeightConverter::class ]);
$convertedValue = $convertManager->convert('10cm to ?in');
```

After you call convert() function all magic happened inside. At the beginning it resolve the query to php form, choose what converter should be used, and in the end converts value to destination unit.

In the output ($convertedValue) you get _Value_ object with the result. 

To calculation values tool is use [BC Math library](http://php.net/manual/en/ref.bc.php). 
 
Tool are tested in [PHPUnit](https://phpunit.de/), so everything should work Without any mistake.

## How to extend Unit Converter

To Extend Converter User should:
 
1. Create new Converter class and Unit class,

2. Add new created Unit class to list of the supported units in the UnitFactory class,

3. During initialization of ConvertManager, add your converter class to list of supported converters.

## Supported PHP Versions
* PHP 7.0 with installed BC Math Extension