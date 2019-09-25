<?php

namespace Company\Split;

class GlobalRegistry
{
    private static $items = [];

    public static function set(string $key, $item)
    {
        self::$items[$key] = $item;
    }

    public static function get(string $key)
    {
        return self::$items[$key] ?? null;
    }
}
