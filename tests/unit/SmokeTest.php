<?php
namespace MilesChou\Bank;

class SmokeTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @test
     */
    public function shouldBeOkayWhenSmokeTest()
    {
        $target = new Query();

        $this->assertInstanceOf(Query::class, $target);
    }
}
