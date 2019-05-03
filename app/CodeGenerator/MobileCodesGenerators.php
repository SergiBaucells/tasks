<?php


namespace App\CodeGenerator;


class MobileCodesGenerators
{

    public static function generate()
    {
        $code = random_int(100000, 999999);
        return $code;
    }

}
