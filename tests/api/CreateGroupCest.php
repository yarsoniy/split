<?php

namespace Company\Split\Tests;

use Symfony\Component\HttpFoundation\Response;

class CreateGroupCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    public function testSuccess(ApiTester $I)
    {
        $I->haveProfile(['username' => 'john']);
        $I->amAuthenticatedAs('john');

        $I->wantToTest("a valid request");
        $I->sendPOST('/groups', ['name' => 'Rich Guys']);

        $I->expectTo("see a success response");
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->seeResponseContainsJson(['name' => 'Rich Guys']);
        $I->seeResponseContains('"id"');
        $I->seeResponseContains('"whenCreated"');
    }

    public function testFail(ApiTester $I)
    {
        $I->haveProfile(['username' => 'john']);
        $I->amAuthenticatedAs('john');

        $I->wantToTest("an invalid request");
        $I->sendPOST('/groups', ['name' => '']);

        $I->expectTo("see an error response");
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
        $I->seeResponseContainsJson([
            "error" => [
                "code" => 400,
                "key" => "validation_error",
                "message" => "Bad request",
                "children" => [
                    [
                        "message" => "This value should not be blank.",
                        "propertyPath" => "name",
                    ],
                ],
            ],
        ]);
    }
}
