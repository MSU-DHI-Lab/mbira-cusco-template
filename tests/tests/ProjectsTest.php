<?php
/** @file
 * @brief Empty unit testing template/database version
 * @cond 
 * @brief Unit tests for the class 
 */


class ProjectsTest extends \PHPUnit_Extensions_Database_TestCase
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
        $projects = new Projects(self::$site);
        $this->assertInstanceOf('Projects', $projects);

    }

    public function test_get() {
        $projects = new Projects(self::$site);
        $project = $projects->get(30);
        $this->assertInstanceOf('Project', $project);
        $this->assertEquals(30, $project->getId());

    }
}
/// @endcond
?>
