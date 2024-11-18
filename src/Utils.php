<?php

namespace Josue\Electroworld;

class Utils
{

    public static function normalizeText(string $text): string
    {
        return preg_replace("/\s+/", " ", trim($text));
    }
}
