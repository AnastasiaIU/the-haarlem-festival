<?php

/**
 * Enum for representing ticket subtypes.
 */
enum TicketSubType: string {
    case FAMILY_TICKET = 'Family Ticket';
    case INDIVIDUAL_TICKET = 'Individual Ticket';
    case ADULTS = 'Adults';
    case KIDS = 'Kids';
}