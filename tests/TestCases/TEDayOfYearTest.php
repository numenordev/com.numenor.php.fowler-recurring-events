<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDayOfYear;

class TEDayOfYearTest extends TestCase
{
    public function testBasicIncorrectDateReturnsFalse()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2021-12-25');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2021-01-01'), 1, 1);
        $testDate = new Carbon('2022-01-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testCorrectDateWithIncorrectFrequencyReturnsFalse()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2022-01-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testCorrectDateWithCorrectFrequencyReturnsTrue()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2021-01-01'), 1, 1, 2);
        $testDate = new Carbon('2023-01-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }

    public function testLeapDayMatchesMarch1OnLeapYearReturnsFalse()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2020-01-01'), 29, 2);
        $testDate = new Carbon('2024-03-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertFalse($result);
    }

    public function testLeapDayMatchesMarch1OffLeapYearReturnsTrue()
    {
        $startOfMonth = new TEDayOfYear(new Carbon('2020-01-01'), 29, 2);
        $testDate = new Carbon('2021-03-01');

        $result = $startOfMonth->includes($testDate);

        $this->assertTrue($result);
    }
}
