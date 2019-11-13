<?php

class LoginCest
{
    private $userData;

    public function _before(FunctionalTester $I)
    {
        $this->userData = [
            'password' => 'abc123456',
            'email' => 'testing@gmail.com'
        ];
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amGoingTo('open login page');
        $I->amOnPage('login');
        $I->wait(2);
        $I->fillField('//*[@id="login-form-from"]/div[1]/input',$this->userData['email']);
        $I->fillField('//*[@id="login-form-from"]/div[2]/input',$this->userData['password']);
        $I->click('#login-form-from > div.text-center > button');
        $I->wait(5);
        $I->seeCurrentUrlEquals('/home');
    }
}
