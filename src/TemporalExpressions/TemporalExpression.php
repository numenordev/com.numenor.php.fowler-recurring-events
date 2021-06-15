<?php

namespace Numenor\FowlerRecurringEvents\TemporalExpressions;

use DateTimeInterface;

interface TemporalExpression
{
    /**
     * Determine whether this Temporal Expression includes the given date.
     * @param DateTimeInterface $date
     * @return bool
     */
    public function includes(DateTimeInterface $date): bool;
}