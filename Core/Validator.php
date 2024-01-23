<?php

namespace Core;

class Validator{
    public static function string($value, $min=1, $max=55){
        $value= trim($value);

        return strlen($value)>= $min && strlen($value)<= $max;
    }
}