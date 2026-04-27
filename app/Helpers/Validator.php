<?php

namespace App\Helpers;

class Validator {
    protected static $errors = [];

    // Check if a value is empty
    public static function required($value, $fieldName) {
        if (empty(trim($value))) {
            self::$errors[$fieldName] = ucfirst($fieldName) . " is required!";
            return false;
        }
        return true;
    }

    // Check for a minimum length
    public static function min($value, $min, $fieldName) {
        if (strlen(trim($value)) < $min) {
            self::$errors[$fieldName] = ucfirst($fieldName) . " must be at least {$min} characters!";
            return false;
        }
        return true;
    }

    // Get all errors
    public static function getErrors() {
        return self::$errors;
    }

    // Check if there are any errors
    public static function hasErrors() {
        return !empty(self::$errors);
    }

    // Clear errors (useful between checks)
    public static function clearErrors() {
        self::$errors = [];
    }
}
