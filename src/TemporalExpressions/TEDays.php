<?php

namespace Numenor\FowlerRecurringEvents\TemporalExpressions;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Class TEDays
 * @package Numenor\FowlerRecurringEvents\TemporalExpressions
 *
 * Temporal Expression for evaluating recurrence on a certain number of days.
 * E.g. "Every day", "Every other day", "Every 10 days"
 */
class TEDays implements TemporalExpression
{
    /** @var DateTimeInterface Starting date of repetition pattern */
    protected $start;

    /** @var int Number of days between repetitions */
    protected $frequency;

    /**
     * TEDays constructor.
     * @param DateTimeInterface $start Starting date of repetition pattern
     * @param int $frequency Number of days between repetitions
     */
    public function __construct(DateTimeInterface $start, int $frequency = 1)
    {
        $this->start = $start;
        $this->frequency = $frequency;
    }

    public function includes(DateTimeInterface $date): bool
    {
        $start = (new Carbon($this->start))->setTime(0, 0);
        $instance = (new Carbon($date))->setTime(0, 0);

        return $instance >= $start
            && $this->hasCorrectFrequencyFromStart($instance, $start);
    }

    protected function hasCorrectFrequencyFromStart(Carbon $instance, Carbon $start): bool
    {
        return $start->diffInDays($instance) % $this->frequency == 0;
    }
}
