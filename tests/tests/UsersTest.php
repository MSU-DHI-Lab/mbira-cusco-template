<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 4/7/16
 * Time: 4:52 PM
 */

class UsersTest extends \PHPUnit_Extensions_Database_TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Site();
        $localize  = require 'localize.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'zhicheng.xu');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_DefaultDataSet();

    }

    public function test_construct() {
        $users = new Users(self::$site);
        $this->assertInstanceOf('Users', $users);
    }
    


}

/// @endcond
?>
