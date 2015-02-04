<?php

namespace rhinoplusfacile\crypt;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-02-04 at 08:33:50.
 */
class CryptTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Crypt
     */
    protected $object;
    protected $message = 'I am a cypher message which shouldnt be able to be decrypted.';
    protected $key = 'selfhelpalongtheway';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Crypt($this->key);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers rhinoplusfacile\crypt\Crypt::encrypt
     * @covers rhinoplusfacile\crypt\Crypt::decrypt
     */
    public function test()
    {
        $cipher = $this->object->encrypt($this->message);
        $decipher = $this->object->decrypt($cipher);
        $this->assertEquals($decipher, $this->message);
    }

}
