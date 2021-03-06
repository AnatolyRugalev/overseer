<?php
require(__DIR__ . '/../_support/User.php');
require(__DIR__ . '/../_support/Book.php');
require(__DIR__ . '/../_support/AuthorRule.php');

use Crisu83\Overseer\Runtime\AssignmentStorage;
use Crisu83\Overseer\Runtime\PermissionStorage;
use Crisu83\Overseer\Runtime\RoleStorage;
use Crisu83\Overseer\Overseer;

class OverseerTest extends \Codeception\TestCase\Test
{
    /**
     * @var $overseer Overseer
     */
    protected $overseer;

    public function _before()
    {
        parent::_before();

        $roleStorage = new RoleStorage;
        $permissionStorage = new PermissionStorage;
        $assignmentStorage = new AssignmentStorage;

        $this->overseer = new Overseer($roleStorage, $permissionStorage, $assignmentStorage);

        $config = require(__DIR__ . '/../_support/config.php');

        $this->overseer->configure($config);
    }

    /**
     * Tests permission return from configuration file
     */
    public function testGetPermissions()
    {
        $myUser = new User(1);
        $myBook = new Book(1);

        $permissions = $this->overseer->getPermissions($myUser, $myBook);

        $this->assertEquals(['book.read', 'book.write', 'book.author'], $permissions);
    }

    /**
     * Tests proper permission returns from for certain object
     */
    public function testHasPermission()
    {

        $myUser = new User(1);
        $myBook = new Book(1);

        $hasPermission = $this->overseer->hasPermission('book.author', $myUser, $myBook);

        $this->assertTrue($hasPermission);
    }
}
