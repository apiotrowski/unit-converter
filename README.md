# Unit Converter

[![Build Status](https://travis-ci.org/apiotrowski/unit-converter.svg?branch=master)](https://travis-ci.org/apiotrowski/unit-converter)

Unit converter it is service which converts values based on query.

QueryExample: 10cm to ?in => 3.93701 

ConvertManager will automatically resolve supported converter and make calculation. In the output it return new Value. 
If ConvertManager would not have specific converter it will throw Exception.

In schedule there will be converter for:
* timestamp to date (UTC),
* length unit,
...