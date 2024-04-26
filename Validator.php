<?php
    
    // class to validate all the inputs
    class Validator
    {
        // example of a function that validates a string
        // the function will return true if the string is valid
        // and false if the string is invalid
        // this function can later be called -> Validator::string('string to validate', 1, 100)
        public static function string($value, $min = 1, $max = INF)
        {
            $value = trim($value);
            return $value > $min && $value < $max;
        }
    }