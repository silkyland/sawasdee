<?php
use \Silkyland\Sawasdee\Sawasdee;
/**
 * Created by PhpStorm.
 * User: Bundit Nuntaes
 * Date: 8/14/2015
 * Time: 4:14 PM
 */
class SawasdeeTest extends PHPUnit_Framework_TestCase
{
    public function testSilkylandToThaiDateTime()
    {
        $sawasdee = new Sawasdee;
        $this->assertEquals('หนึ่งร้อยยี่สิบสามบาทถ้วน',$sawasdee->readThaiCurrency('123'));
    }
}
