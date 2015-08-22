<?php

/**
 * This file is part of the ArrayUtils library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\ArrayUtils;

class ArrayComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider equalArraysProvider
     * 
     * @param array $arr1
     * @param array $arr2
     */
    public function testComparingEqualArrays(array $arr1, array $arr2)
    {
        $this->assertTrue(ArrayComparator::arraysHoldEqualElements($arr1, $arr2));
    }
    
    public function equalArraysProvider()
    {
        $A = new \stdClass();
        $B = new \stdClass();
        $C = new \stdClass();
        return [
            [
                [$A, $B, $C],
                [$A, $B, $C],
            ],
            [
                [$A, $B, $C],
                [$C, $B, $A],
            ],
            [
                [$A, $B, $C],
                [$A, $C, $B],
            ],
        ];
    }

    /**
     * @dataProvider differentArraysProvider
     * 
     * @param array $arr1
     * @param array $arr2
     */
    public function testComparingDifferentArrays(array $arr1, array $arr2)
    {
        $this->assertFalse(ArrayComparator::arraysHoldEqualElements($arr1, $arr2));
    }
    
    public function differentArraysProvider()
    {
        $A = new \stdClass();
        $B = new \stdClass();
        $C = new \stdClass();
        $D = new \stdClass();
        return [
            [
                [$A, $B],
                [$C, $D],
            ],
            [
                [$A, $B],
                [$A, $B, $B],
            ],
            [
                [$A, $A, $B],
                [$A, $B],
            ],
            [
                [$A, $B, $C],
                [$A, $B],
            ],
        ];
    }
    
    /**
     * @dataProvider customEqualityCmpDataProvider
     * 
     * @param array $arr1
     * @param array $arr2
     * @param boolean $areEqual true if these two arrays should be considered as equal
     */
    public function testCustomEqualityCompareFunction(array $arr1, array $arr2, $areEqual)
    {
        $this->assertEquals(
            $areEqual,
            ArrayComparator::arraysHoldEqualElements(
                $arr1,
                $arr2,
                function ($arr1Elem, $arr2Elem) {
                    return ((2 * $arr1Elem) === $arr2Elem);
                }  
            )
        );
    }
    
    public function customEqualityCmpDataProvider()
    {
        return [
            [
                [1, 2, 3],
                [2, 4, 6],
                true
            ],
            [
                [1, 2, 3],
                [2, 2, 6],
                false
            ],
            [
                [2, 4, 6],
                [1, 2, 3],
                false
            ],
        ];
    }
}
