<?php

namespace App\Helpers;

class Contains
{
    function contains($x, $y)
    {
        if(!is_array($x)){
            $x =array($x);
        }
        if(!is_array($y)){
            $y = array($y);
        }

        return !array_diff($y, $x);
    }
}
