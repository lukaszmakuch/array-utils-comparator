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
    /*
     * Checks whether two arrays hold equal elements.
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
