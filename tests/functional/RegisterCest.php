<?php

class RegisterCest
{
    private $userData;

    public function _before(FunctionalTester $I)
    {
        $this->userData = [
            'name' => 'Test user',
            'password' => 'abc123456',
            'email' => 'testing@gmail.com'
        ];
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amGoingTo('open register page');
        $I->amOnPage('register');
        $I->wait(2);
        $I->fillField('//*[@id="register-form-from"]/div[1]/input',$this->userData['name']);
        $I->fillField('//*[@id="register-form-from"]/div[2]/input',$this->userData['email']);
        $I->see('Email is ok','//*[@id="register-form-from"]/div[2]/small');
        $I->fillField('//*[@id="register-form-from"]/div[3]/input',$this->userData['password']);
        $I->fillField('//*[@id="register-form-from"]/div[4]/input',$this->userData['password']);
        $I->click('#register-form-from > div.text-center > button');
        $I->wait(5);
        $I->seeCurrentUrlEquals('/home');
    }
}
