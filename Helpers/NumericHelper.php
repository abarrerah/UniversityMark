<?php 

class NumericHelper {
    public static function normalize($value): string
    {
        if (!is_scalar($value)) {
            $type = gettype($value);
            throw new InvalidArgumentException("Value must be scalar. $type given.");
        }

        if (is_bool($value)) {
            $value = $value ? '1' : '0';
        } else {
            $value = (string)$value;
        }
        $value = str_replace([' ', ','], ['', '.'], $value);
        return preg_replace('/\.(?=.*\.)/', '', $value);
    }
}

?>