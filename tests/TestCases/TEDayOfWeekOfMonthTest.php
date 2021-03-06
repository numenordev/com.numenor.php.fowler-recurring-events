<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfWeekOfMonth;
use PHPUnit\Framework\TestCase;

class TEDayOfWeekOfMonthTest extends TestCase
{
    public function testCorrectDateBeforePatternStartReturnsFalse()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2020-01-06');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicIncorrectDateReturnsFalse()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2021-01-03');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2021-01-04');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2021-02-01');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2021-03-01');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateFromEndWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, -1, 2);
        $testDate = new Carbon('2021-02-22');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateFromEndWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, -1, 2);
        $testDate = new Carbon('2021-03-29');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateAcrossYearsWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 5);
        $testDate = new Carbon('2022-01-03'); //12 months later

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateAcrossYearsWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 5);
        $testDate = new Carbon('2022-04-04'); //15 months later

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }
}
