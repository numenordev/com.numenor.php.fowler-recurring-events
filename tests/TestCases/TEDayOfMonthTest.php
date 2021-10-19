<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfMonth;
use PHPUnit\Framework\TestCase;

class TEDayOfMonthTest extends TestCase
{
    public function testCorrectDateBeforePatternStartReturnsFalse()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2020-01-01');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicIncorrectDateReturnsFalse()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2021-12-25');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2021-12-01');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 2);
        $testDate = new Carbon('2021-12-01');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 2);
        $testDate = new Carbon('2021-11-01');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateFromEndWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), -1, 2);
        $testDate = new Carbon('2021-12-31');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateFromEndWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), -1, 2);
        $testDate = new Carbon('2021-11-30');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateAcrossYearsWithIncorrectFrequencyReturnsFalse()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 5);
        $testDate = new Carbon('2022-01-01'); //12 months later

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateAcrossYearsWithCorrectFrequencyReturnsTrue()
    {
        $pattern = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 5);
        $testDate = new Carbon('2022-04-01'); //15 months later

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }
}
