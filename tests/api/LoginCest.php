<?php

namespace Company\Split\Tests;

use Company\Split\Infrastructure\Security\User;
use Symfony\Component\HttpFoundation\Response;

class LoginCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    public function testSuccess(ApiTester $I)
    {
        $I->wantToTest("login success");
        $I->haveProfile(['username' => 'beta', 'password' => '1111']);
        $I->amGoingTo("send login request");
        $I->sendPOST('/login', ["username" => "beta", "password" => "1111"]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"token"');
    }

    public function testFail(ApiTester $I)
    {
        $I->amGoingTo("check that I dont have a user 'alpha'");
        $I->dontSeeInRepository(User::class, ['username' => 'alpha']);
        $I->sendPOST('/login', ["username" => "alpha", "password" => "1234"]);
        $I->seeResponseCodeIs(Response::HTTP_UNAUTHORIZED);
        $I->seeResponseIsJson();
        $I->dontSeeResponseContains('"token"');
        $I->seeResponseContainsJson([
            "code" => 401,
            "message" => "Invalid credentials.",
        ]);
    }
}
