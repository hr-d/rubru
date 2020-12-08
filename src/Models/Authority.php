<?php


namespace HRD\Rubru\Models;


use phpDocumentor\Reflection\DocBlock\Tags\See;
use phpDocumentor\Reflection\Types\Self_;

class Authority
{
    const ACCESS_LEVEL_NORMAL = "SUBSCRIBER";
    const ACCESS_LEVEL_PUBLISHER = "PUBLISHER";
    const ACCESS_LEVEL_ADMIN = "MODERATOR";

    public static function get_authorities()
    {
        return [
            self::ACCESS_LEVEL_NORMAL,
            self::ACCESS_LEVEL_PUBLISHER,
            self::ACCESS_LEVEL_ADMIN,
        ];
    }

    public static function check(string $authorityName)
    {
        if (in_array($authorityName, Self::get_authorities())) {
            return true;
        }
        return false;
    }
}
