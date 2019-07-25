<?php

namespace App;

class Helper
{
    /**
     * Make a string as array with key as id
     *
     * @param string $id
     * @return array
     */
    public static function arrayId(string $id)
    {
        return ['id' => $id];
    }
}
