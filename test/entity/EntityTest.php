<?php
namespace rhinoplusfacile\entity;
//require_once($_SERVER['DOCUMENT_ROOT'] . '/entity/Entity.php');
/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-07-24 at 10:09:19.
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \entity\Entity
     */
    protected $object;
    protected $id = 17;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = $this->getMock('rhinoplusfacile\\entity\\Entity', null, array($this->id));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers entity\Entity::getId
     * @todo   Implement testGetId().
     */
    public function testGetId()
    {
        $this->assertEquals($this->object->getId(), $this->id);
    }
}
