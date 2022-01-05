<?php

namespace Validate;

use App\App;

class Validate
{
    public function validateEmail($email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $line = App::$lineCount;
            die(print "Invalid email format in line: $line!");
        } else {
            return $email;
        }
    }

    public function validatePhone($phone): string
    {
        if (!preg_match("/[+][3][7][0][0-9]{8}/", $phone)) {
            $line = App::$lineCount;
            die(print "Invalid phone number format in line: $line!");
        } else {
            return $phone;
        }
    }

    public function validateDate($date): string
    {
        if (!preg_match("/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/", $date)) {
            $line = App::$lineCount;
            die(print "Invalid date formati in line: $line!");
        } else {
            return $date;
        }
    }

    public function validateTime($time): string
    {
        if (!preg_match("/(?:2[0-4]|[01][1-9]|10):([0-5][0-9])/", $time)) {
            $line = App::$lineCount;
            die(print "Invalid time format in line: $line!");
        } else {
            return $time;
        }
    }
}
