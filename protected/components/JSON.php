<?php


class JSON extends CJSON
{

    public static function response($var)
    {
        header('Content-type: application/json');
        echo CJSON::encode($var);
    }

}