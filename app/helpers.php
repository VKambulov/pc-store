<?php

if (!function_exists('__ucfirst')) {
    function __ucfirst(string $value): string
    {
        return str(__($value))->ucfirst();
    }
}
