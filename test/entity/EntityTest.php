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
     */
    public function testGetId()
    {
        $this->object = $this->getMock('rhinoplusfacile\\entity\\Entity', null, array($this->id));
        $this->assertEquals($this->object->getId(), $this->id);
        $this->object = $this->getMock('rhinoplusfacile\\entity\\Entity', null);
        $this->assertEquals($this->object->getId(), spl_object_hash($this->object));
    }

    /**
     * @covers entity\Entity::setId
     */
    public function testSetId()
    {
        $this->object = $this->getMock('rhinoplusfacile\\entity\\Entity', null, array($this->id));
        $rclass = new \ReflectionClass($this->object);
        $rmethod = $rclass->getMethod('setId');
        $rmethod->setAccessible(true);
        $rmethod->invoke($this->object, 3);
        $this->assertEquals($this->object->getId(), 3);
    }

}
