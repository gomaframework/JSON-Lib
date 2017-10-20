<?php

namespace Goma\JSON\Test;

use Goma\JSON\JSON;

defined("IN_GOMA") OR die();

/**
 * Tests JSON class.
 *
 * @package    goma/...
 * @link    http://goma-cms.org
 * @license LGPL http://www.gnu.org/copyleft/lesser.html see 'license.txt'
 * @author    Goma-Team
 */
class JSONTest extends \GomaUnitTest
{
    protected static $basicJson = array("json" => 1);

    protected static $basicJsonString = "{\"json\":1}";

    /**
     * tests a basic example of correct json encoding.
     *
     * 1. Encode $basicJson (defined above) with JSON::encode, set to $result
     * 2. Assert that $result is equal to $basicJsonString (defined above)
     */
    public function testBasicJSONEncode() {
        $result = JSON::encode(self::$basicJson);
        $this->assertEqual(self::$basicJsonString, $result);
    }
}
