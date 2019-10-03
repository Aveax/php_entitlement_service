<?php

namespace App\Helpers;

class Contains
{
    private $x;
    private $y;

    function __construct($x, $y)
    {
        if(is_array($x)){
            $this->x = $x;
        }else{
            $this->x =array($x);
        }
        if(is_array($y)){
            $this->y = $y;
        }else{
            $this->y = array($y);
        }
    }

    function contains()
    {
        return !array_diff($this->y, $this->x);
    }
}
