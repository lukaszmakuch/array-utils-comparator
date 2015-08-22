# ArrayComparator
Allows to compare arrays.

## Usage
### arraysHoldEqualElements
By default this method checks whether two arrays contain equal elements by strict comparison (===).
``` php
ArrayComparator::arraysHoldEqualElements([1, 2, 3], [1, 2, 3]); //true
ArrayComparator::arraysHoldEqualElements([1, 2, 3], [1, 2, 3, 4]); //false
ArrayComparator::arraysHoldEqualElements([1, 2, 3], [1, 3, 2]); //true
```
But it's also possible to provide custom value compare function.
``` php
ArrayComparator::arraysHoldEqualElements(
    [1, 2, 3],
    [2, 4, 6],
    function ($arr1Elem, $arr2Elem) {
		return ((2 * $arr1Elem) === $arr2Elem);
    }  
); //true
```


## Installation
Use [composer](https://getcomposer.org) to get the latest version:
```
$ composer require lukaszmakuch/array-utils-comparator
```
