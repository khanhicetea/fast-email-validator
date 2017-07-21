<?php
namespace FastEmailValidator;

class Utils {
    public static function normalizeObjectName(string $text): string {
        return '_'.str_replace(['-', '.'], ['__', '_'], trim($text));
    }

    public static function checkPropertyExists(string $text, $object): bool {
        $key = static::normalizeObjectName($text);
        return isset($object->{$key});
    }
}
