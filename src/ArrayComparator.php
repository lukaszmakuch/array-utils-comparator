<?php

/**
 * This file is part of the ArrayUtils library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\ArrayUtils;

class ArrayComparator
{
    /**
     * Checks whether two arrays hold equal elements.
     * 
     * Order of elements does not matter.
     * 
     * @param int $arr1 first of two arrays to compare
     * @param int $arr2 second of two arrays to compare
     * @param callable $valueCompareFunction optional function
     * used to compare array values for equality. 
     * Must return true  if two compared values are equal or false if they are not. 
     * Takes an element of the first array as its first argument and 
     * an element of the second array as its second (and the last) argument.
     * <pre>
     * boolean callback(mixed $arr1Element, $arr2Element)
     * </pre>
     * 
     * @return boolean true if arrays hold equal values, false otherwise
     */
    public static function arraysHoldEqualElements(
        array $arr1,
        array $arr2,
        callable $valueCompareFunction = null
    ) {
        if (null === $valueCompareFunction) {
            $valueCompareFunction = function ($arr1Elem, $arr2Elem) {
                return $arr1Elem === $arr2Elem;
            };
        }
        
        foreach ($arr1 as $arr1Elem) {
            $newArr2 = [];
            $arr1ElemFoundInArr2 = false;
            foreach ($arr2 as $arr2Elem) {
                if (
                    (false === $arr1ElemFoundInArr2)
                    && $valueCompareFunction($arr1Elem, $arr2Elem)
                ) {
                    $arr1ElemFoundInArr2 = true;
                } else {
                    $newArr2[] = $arr2Elem;
                }
            }
            
            if (false === $arr1ElemFoundInArr2) {
                return false;
            }
            
            $arr2 = $newArr2;
        }
        
        return empty($arr2);
    }
}
