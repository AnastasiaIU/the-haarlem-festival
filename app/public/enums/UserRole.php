<?php

/**
 * Enum for representing user roles.
 */
enum UserRole: string
{
    case CUSTOMER = 'Customer';
    case EMPLOYEE = 'Employee';
    case ADMINISTRATOR = 'Administrator';
}
