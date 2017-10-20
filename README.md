Goma JSON Lib
=======

Goma JSON Lib provides Exception handling for JSON encode and decode. It has a workaround for non-utf8 values. 

Methods
--
* **JSON::encode( mixed $value [[, int $options = 0 [, int $depth = 512 ]], bool $throwNonUtf8 = false])** - encodes data. If utf8 error is thrown, it tries a workaround. For every other kind of error JSONException is thrown.
* **JSON::decode(string $json [, bool $assoc = false [, int $depth = 512 [, int $options = 0 ]]])** - decodes an json string. Throws JSONException in case of a problem.

JSONException
--
The code of the JSONException is the same as json_last_error(). Message is json_last_error_msg(). 
