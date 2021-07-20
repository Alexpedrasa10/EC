<?php

class Helper 
{

    public function getProperties($code, $active = 1, $forProducts = null)
    {
        $response = Property::where('code', $code)->where('active', $active);
        return $response;
    }


}