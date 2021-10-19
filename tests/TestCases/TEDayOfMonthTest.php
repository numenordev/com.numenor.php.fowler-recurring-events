<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfMonth;


class TEDayOfMonthTest extends TestCase
{
    public function testBasicIncorrectDateReturnsFalse()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2021-12-25');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {

        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2021-12-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 2);
        $testDate = new Carbon('2021-12-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 2);
        $testDate = new Carbon('2021-11-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateFromEndWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), -1, 2);
        $testDate = new Carbon('2021-12-31');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateFromEndWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), -1, 2);
        $testDate = new Carbon('2021-11-30');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateAcrossYearsWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 5);
        $testDate = new Carbon('2022-01-01'); //15 months later

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateAcrossYearsWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfMonth(new Carbon('2021-01-01'), 1, 5);
        $testDate = new Carbon('2022-04-01'); //15 months later

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }
}
