<?php

/**
 * Enum for representing day pass types.
 */
enum DayPass: string {
    case FRIDAY = 'Friday';
    case SATURDAY = 'Saturday';
    case SUNDAY = 'Sunday';
    case ALL_ACCESS = 'All-Access';
}