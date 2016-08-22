<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 4/7/16
 * Time: 4:31 PM
 */

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $row = array('id' => 1,
            'username' => 'kora',
            'email' => 'kora@matrix.com',
            'password' => 'kora123',
            'firstName' => 'kora',
            'lastName' => 'matrix');
        $user = new User($row);
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('kora', $user->getUsername());
        $this->assertEquals('kora@matrix.com', $user->getEmail());
        $this->assertEquals('kora', $user->getFirstName());
        $this->assertEquals('matrix', $user->getLastName());
    }
}

/// @endcond
?>
