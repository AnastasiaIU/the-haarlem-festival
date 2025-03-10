<?php

/**
 * Enum for representing ticket types.
 */
enum TicketType: string {
    case PASS = 'pass';
    case DANCE_SHOW = 'dance_show';
    case RESERVATION = 'reservation';
    case TOUR = 'tour';
    case TEYLERS_EVENT = 'teylers_event';
}