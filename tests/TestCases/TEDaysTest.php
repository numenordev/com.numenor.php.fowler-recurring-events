<?php

namespace Tests\TestCases;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Numenor\FowlerRecurringEvents\TemporalExpressions\TEDays;

class TEDaysTest extends TestCase
{
    public function testBasicIncorrectDateReturnsFalse()
    {
        $pattern = new TEDays(new Carbon('2021-01-01'), 5);
        $testDate = new Carbon('2021-01-02');

        $result = $pattern->includes($testDate);

        $this->assertFalse($result);
    }

    public function testBasicCorrectDateReturnsTrue()
    {
        $pattern = new TEDays(new Carbon('2021-01-01'), 1);
        $testDate = new Carbon('2021-01-06');

        $result = $pattern->includes($testDate);

        $this->assertTrue($result);
    }
}
