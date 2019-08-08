<?php

use bigpaulie\simple\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorTest
 */
class CalculatorTest extends TestCase
{
    public function testAddNumbers()
    {
        $calculator = new Calculator();
        $addition = $calculator->add(1, 1);
        $this->assertEquals($addition, 2);
    }
}