<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */


class ExhibitsTest extends \PHPUnit_Extensions_Database_TestCase
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

        //return $this->createFlatXMLDataSet(dirname(__FILE__) .
        //	'/db/users.xml');
    }

    public function test_construct() {
        $exhibits = new Exhibits(self::$site);
        $this->assertInstanceOf('Exhibits', $exhibits);

    }

    public function test_get() {
        $exhibits = new Exhibits(self::$site);
        $exhibit = $exhibits->get(1);
        $this->assertInstanceOf('Exhibit', $exhibit);
    }

    public function test_getCount() {
        $exhibits = new Exhibits(self::$site);
        $count = $exhibits->getCount();
        $this->assertEquals(7,$count);
    }

    public function test_getTitles() {
        $exhibits = new Exhibits(self::$site);
        $titles = $exhibits->getTitles();
        $title1 = $titles[1];
        //$type = gettype($title1);
        //echo $type;
        var_dump($titles);
    }

    public function test_getLocationID() {
        $exhibits = new Exhibits(self::$site);
        $locationID = $exhibits->getLocationID(7);
        var_dump(($locationID));
    }
}
/// @endcond
?>
