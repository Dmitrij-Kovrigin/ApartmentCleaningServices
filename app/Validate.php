<?php

namespace Validate;

class Validate
{
    public function validateEmail($email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die(print "Invalid email format!");
        } else {
            return $email;
        }
    }

    public function validatePhone($phone): string
    {
        if (!preg_match("/[+][3][7][0][0-9]{8}/", $phone)) {
            die(print "Invalid phone number format!");
        } else {
            return $phone;
        }
    }

    public function validateDate($date): string
    {
        if (!preg_match("/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/", $date)) {
            die(print "Invalid date format!");
        } else {
            return $date;
        }
    }

    public function validateTime($time): string
    {
        if (!preg_match("/(?:2[0-4]|[01][1-9]|10):([0-5][0-9])/", $time)) {
            die(print "Invalid time format!");
        } else {
            return $time;
        }
    }
}
