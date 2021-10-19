<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfWeekOfMonth;
use PHPUnit\Framework\TestCase;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfMonth;

class TEDayOfWeekOfMonthTest extends TestCase
{
    public function testBasicIncorrectDateReturnsFalse()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2021-01-03');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {

        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2021-01-04');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2021-02-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2021-03-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateFromEndWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, -1, 2);
        $testDate = new Carbon('2021-02-22');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateFromEndWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, -1, 2);
        $testDate = new Carbon('2021-03-29');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateAcrossYearsWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 5);
        $testDate = new Carbon('2022-01-03'); //12 months later

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateAcrossYearsWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfWeekOfMonth(new Carbon('2021-01-01'), 1, 1, 5);
        $testDate = new Carbon('2022-04-04'); //15 months later

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }
}
