<?php

namespace Company\Split\Tests;

use Symfony\Component\HttpFoundation\Response;

class CreateProfileCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    public function testInvalidRequest(ApiTester $I)
    {
        $I->amGoingTo("test an invalid request");
        $I->sendPOST('/profiles', [
            "username" => "alpha",
            "password" => "1234",
            "fullName" => "",
            "emailAddress" => "alpha2test.com"
        ]);

        $I->expectTo("see an error for email param");
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "error" => [
                "code" => 400,
                "key" => "validation_error",
                "message" => "Bad request",
                "children" => [
                    [
                        "message" => "This value should not be blank.",
                        "propertyPath" => "fullName",
                    ],
                    [
                        "message" => "This value is not a valid email address.",
                        "propertyPath" => "emailAddress",
                    ],
                ],
            ],
        ]);
    }
}
