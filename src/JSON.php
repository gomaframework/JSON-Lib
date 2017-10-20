<?php

namespace Goma\JSON;

/**
 * JSON class provides encoding and decoding.
 * It throws JSONException in case of an error.
 * It automatically tries to fix utf8 errors at encoding.
 *
 * @package    goma/json
 * @link    http://goma-cms.org
 * @license LGPL http://www.gnu.org/copyleft/lesser.html see 'license.txt'
 * @author    Goma-Team
 */
class JSON
{
    /**
     * encodes a value to json.
     * Throws exception in case of an error.
     * Tries to repair utf8 in case of $throwNonUtf8 is false (default value).
     *
     * @param mixed $value
     * @param int $options same as of json_encode ({@link http://php.net/manual/de/function.json-encode.php})
     * @param int $depth max depth of json array
     * @param bool $throwNonUtf8
     * @return string
     * @throws JSONException
     */
    public static function encode($value, $options = 0, $depth = 512, $throwNonUtf8 = false) {
        $json = json_encode($value, $options, $depth);

        if($json === false && json_last_error() != JSON_ERROR_NONE) {
            if(!$throwNonUtf8 && json_last_error() == JSON_ERROR_UTF8) {
                $valueUtf8 = self::utf8ize($value);
                return self::encode($valueUtf8, $options, $depth, true);
            } else {
                throw new JSONException(json_last_error_msg(), json_last_error(), true);
            }
        }

        return $json;
    }

    /**
     * decodes a value from json.
     * Throws exception in case of an error.
     * Parameters are the same as of json_decode ({@link http://php.net/manual/de/function.json-decode.php})
     *
     * @param string $json
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     * @return mixed
     * @throws JSONException
     */
    public static function decode($json, $assoc = false, $depth = 512, $options = 0) {
        $decodedValue = json_decode($json, $assoc, $depth, $options);

        if($decodedValue === null && json_last_error() != JSON_ERROR_NONE) {
            throw new JSONException(json_last_error_msg(), json_last_error(), false);
        }

        return $decodedValue;
    }

    /**
     * @param array $mixed
     * @return array|string
     */
    protected static function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = self::utf8ize($value);
            }
        } else if (is_string ($mixed)) {
            return utf8_encode($mixed);
        }
        return $mixed;
    }
}
