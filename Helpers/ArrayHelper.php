<?php 
class ArrayHelper {
    
    public function __construct(){}
    
    public static function getValue(
        array|object $array,
        array|Closure|float|int|string $key,
        mixed $default = null
    ): mixed {
        if ($key instanceof Closure) {
            return $key($array, $default);
        }

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                /** @var mixed */
                $array = self::getRootValue($array, $keyPart, null);
                if (!is_array($array) && !is_object($array)) {
                    return $default;
                }
            }
            return self::getRootValue($array, $lastKey, $default);
        }

        return self::getRootValue($array, $key, $default);
    }

    private static function getRootValue(mixed $array, float|int|string $key, mixed $default): mixed
    {
        if (is_array($array)) {
            $key = self::normalizeArrayKey($key);
            return array_key_exists($key, $array) ? $array[$key] : $default;
        }

        if (is_object($array)) {
            $key = (string) $key;

            if (str_ends_with($key, '()')) {
                $method = substr($key, 0, -2);
                return $array->$method();
            }

            try {
                return $array::$$key;
            } catch (Throwable) {
                return $array->$key;
            }
        }
        return $default;
    }

    private static function normalizeArrayKey(mixed $key): string
    {
        return is_float($key) ? NumericHelper::normalize($key) : (string)$key;
    }
}

?>