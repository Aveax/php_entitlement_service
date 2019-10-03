<?php

namespace App\Helpers;

class Datetime
{

    function checkIfNotExpired($y)
    {
        if(date('Y-m-d H:i:s ', time()) <= $y){
            return true;
        }
        return false;
    }
}
