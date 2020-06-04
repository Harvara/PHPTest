<?php


class firstCest
{
    public function _before(AcceptanceTester $I){
        $I->amOnPage("/index.php");
    }

    public function isHelloWolrdThere(AcceptanceTester $I){
        $I->see("Hello World");
    }
}