<?php

/**
 * Enum for representing ticket subtypes.
 */
enum TicketSubType: string {
    case FAMILY = 'Family';
    case INDIVIDUAL = 'Individual';
    case ADULTS = 'Adults';
    case KIDS = 'Kids';
}