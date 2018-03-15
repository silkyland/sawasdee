<?php
use \Silkyland\Sawasdee;

/**
 * Created by PhpStorm.
 * User: Bundit Nuntaes
 * Date: 15/03/2018
 * Time: 12:00 AM
 */
class SawasdeeTest extends PHPUnit_Framework_TestCase
{
    public function testSilkylandToThaiDateTime()
    {
        $sawasdee = new Sawasdee;
        $this->assertEquals('หนึ่งร้อยยี่สิบสามบาทถ้วน', $sawasdee->readThaiCurrency('123'));
    }
}
