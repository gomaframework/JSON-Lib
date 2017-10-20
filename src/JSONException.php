<?php

namespace Goma\JSON;

use Throwable;

defined("IN_GOMA") OR die();

/**
 * JSONException is the thrown error in case of an error of JSON class.
 *
 * * It's code is the same code schema as of json_last_error() ({@link http://php.net/manual/de/function.json-last-error.php}).
 * * It's message is the same as of json_last_error_msg() ({@link http://php.net/manual/de/function.json-last-error-msg.php}).
 * * isEncodingError returns true if error was at encoding and false if it was at decoding.
 *
 * @package    goma/json
 * @link    http://goma-cms.org
 * @license LGPL http://www.gnu.org/copyleft/lesser.html see 'license.txt'
 * @author    Goma-Team
 */
class JSONException extends \Exception
{
    /**
     * defines if encoding or decoding error.
     * @var bool
     */
    protected $encodingError;

    /**
     * JSONException constructor.
     * @param string $message
     * @param int $code
     * @param bool $encoding
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $encoding = false, Throwable $previous = null)
    {
        $this->encodingError = $encoding;

        if($code == JSON_ERROR_NONE) {
            throw new \LogicException("JSONException was generated without an error.");
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * returns true if error was at encoding and false if it was at decoding.
     *
     * @return bool
     */
    public function isEncodingError()
    {
        return $this->encodingError;
    }
}
