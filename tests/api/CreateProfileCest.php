<?php

namespace Company\Split\Tests;

use Company\Split\Domain\Person\Person;
use Company\Split\Infrastructure\Security\User;
use Symfony\Component\HttpFoundation\Response;

class CreateProfileCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
    }

    public function testSuccess(ApiTester $I)
    {
        $I->wantToTest("a valid request");
        $I->sendPOST('/profiles', [
            "username" => "alpha",
            "password" => "1234",
            "fullName" => "Alpha Centauri",
            "emailAddress" => "alpha@test.com"
        ]);

        $I->expectTo("see a success response");
        $I->seeResponseCodeIs(Response::HTTP_CREATED);
        $I->seeResponseContainsJson([
            'username' => 'alpha',
            'fullName' => 'Alpha Centauri',
            'emailAddress' => 'alpha@test.com',
        ]);

        $I->expectTo("see that the response contains id");
        $I->seeResponseContains('"id"');

        $I->expectTo("see that the response does'n contain password");
        $I->dontSeeResponseContains('"password"');

        $I->expectTo("see the domain entity Person and security entity User are saved");
        $profileId = $I->grabDataFromResponseByJsonPath("$.id")[0];
        $I->seeInRepository(Person::class, ['id' => $profileId]);
        $I->seeInRepository(User::class, ['id' => $profileId]);
    }

    /**
     * @param ApiTester $I
     *
     */
    public function testNotUniqueUsername(ApiTester $I)
    {
        $I->haveProfile(['username' => 'beta']);
        $I->amGoingTo("create another profile with the same username");
        $I->sendPOST('/profiles', [
            "username" => "beta",
            "password" => "2222",
            "fullName" => "Beta Second",
            "emailAddress" => "beta2@test.com"
        ]);

        $I->expect("to get an error");
        $I->seeResponseCodeIs(Response::HTTP_CONFLICT);
        $I->seeResponseContainsJson([
            "error" => [
                "code" => 409,
                "key" => "username_is_not_unique",
                "message" => "Username already exists",
                "propertyPath" => "username",
            ],
        ]);
    }

    public function testInvalidRequest(ApiTester $I)
    {
        $I->wantToTest("an invalid request");
        $I->sendPOST('/profiles', [
            "username" => "alpha",
            "password" => "1234",
            "fullName" => "",
            "emailAddress" => "alpha2test.com"
        ]);

        $I->expectTo("see an error for email param");
        $I->seeResponseCodeIs(Response::HTTP_BAD_REQUEST);
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
