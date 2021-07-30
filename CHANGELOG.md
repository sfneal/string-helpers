# Changelog

All notable changes to `string-helpers` will be documented in this file


## 0.1.0 - 2020-08-19
- initial release


## 0.1.1 - 2020-08-27
- add random_password() helper function


## 0.1.2 - 2020-08-28
- refactor random_password() to randomPassword()


## 0.1.3 - 2020-08-28
- make StringHelpers class


## 0.1.4 - 2020-08-28
- add missing type hinting


## 0.1.5 - 2020-09-09
- fix inString() helper function to allow for arrays of needles


## 0.1.6 - 2020-10-05
- add joinPaths() helper function for concatenating arrays of paths


## 0.2.0 - 2020-10-05
- add support for php 7.0 & 7.1


## 0.2.1 - 2020-10-05
- bump sfneal/array-helpers version requirement


## 0.2.2 - 2020-10-05
- fix issues with composer.json


## 0.2.3 - 2020-12-01
- bump min php unit version


## 0.3.0 - 2020-12-09
- add whitespaceRemove() & whitespaceReplace() helper functions with tests


## 0.4.0 - 2020-12-10
- cut support for php7.0
- improved type hinting to helper functions


## 0.4.1 - 2020-12-14
- fix issue with implodePretty() helper functions return type hinting


## 1.0.0 - 2021-01-20
- initial production release
- cut autoloading of helper functions by default 
- update docs to explain autoloading & provide an example
- optimize Travis CI test time by fixing issues with composer caching


## 1.0.1 - 2021-01-21
- fix sfneal/array-helpers min version
- fix use of ArrayHelpers


## 1.1.0 - 2021-02-04
- make StaticHelpersTest for testing helper methods not included in StringHelpers
- add functionality to StaticMethods so that they can be accessed with StringHelpers
- refactor StaticHelpersTest to use StringHelpers import
- refactor zero_replace static method to zeroReplace


## 1.1.1 - 2021-02-04
- fix min phpunit/phpunit version


## 1.1.2 - 2021-03-03
- add `extractEmailDomain()` method for extracting domains from email addresses


## 1.1.3 - 2021-03-09
- add `StringHelpers::fill()` method for filling a string with whitespace to make it a particular length


## 1.1.4 - 2021-03-24
- add `StringHelpers::camelCaseSplit()` method to StringHelpers for splitting a camel cased string


## 1.2.0 - 2021-07-27
- refactor test classes to 'tests/Units' & 'tests/Feature' directories
- add orchestra/testbench to composer dev requirements
- add test assertions to `StringHelpersTest` methods
- fix issues with `StringHelpersTest` `id()` & `strip()` assertions
- make `Regex` for retrieving regular expression patterns
- add use of `Regex::NOT_NUMBERS_OR_LETTERS_OR_UNDERSCORE` in `StringHelpers::removeDuplicateChars()`


## 1.2.1 - 2021-07-30
- fix sfneal/array-helpers dependency to be more explicit
