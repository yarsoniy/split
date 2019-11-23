<?php

namespace Company\Split\Tests;

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
        $I->amGoingTo("create the profile first");
        $I->sendPOST('/profiles', [
            "username" => "beta",
            "password" => "1111",
            "fullName" => "Beta First",
            "emailAddress" => "beta1@test.com"
        ]);
        $I->seeResponseCodeIs(Response::HTTP_CREATED);

        $I->amGoingTo("send login request");
        $I->sendPOST('/login', ["username" => "beta", "password" => "1111"]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"token"');
    }

    public function testFail(ApiTester $I)
    {
        $I->sendPOST('/login', ["username" => "alpha", "password" => "1234"]);
        $I->seeResponseCodeIs(Response::HTTP_UNAUTHORIZED);
        $I->seeResponseIsJson();
        $I->dontSeeResponseContains('"token"');
        $I->seeResponseContainsJson([
            "code" => 401,
            "message" => "Bad credentials.",
        ]);
    }
}
