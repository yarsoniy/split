<?php namespace Company\Split\Tests\RestResource;

use Company\Split\Controller\Rest\Resource\ProfileResource;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileResourceTest extends \Codeception\Test\Unit
{
    /**
     * @var \Company\Split\Tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider providerValidate
     * @param $params
     * @param $expectedErrors
     */
    public function testValidate($params, $expectedErrors)
    {
        /** @var ValidatorInterface $validator */
        $validator = $this->tester->grabService('validator');

        $resource = new ProfileResource();

        $resource->username = $params['username'];
        $resource->password = $params['password'];
        $resource->fullName = $params['fullName'];
        $resource->emailAddress = $params['emailAddress'];

        $actual = $validator->validate($resource);
        $this->assertCount(count($expectedErrors), $actual);

        /** @var ConstraintViolation $actualViolation */
        foreach ($actual as $actualViolation) {
            $propertyPath = $actualViolation->getPropertyPath();
            $this->assertArrayHasKey($propertyPath, $expectedErrors);

            $expectedError = $expectedErrors[$propertyPath];
            $this->assertEquals($expectedError, $actualViolation->getMessage());
        }
    }

    /**
     * @return array
     */
    public function providerValidate()
    {
        return [
            0 => [
                'params' => [
                    'username' => 'alpha',
                    'password' => '1111',
                    'fullName' => 'Alpha Centauri',
                    'emailAddress' => 'alpha@test.com',
                ],
                'expectedErrors' => [],
            ],
            1 => [
                'params' => [
                    'username' => null,
                    'password' => null,
                    'fullName' => null,
                    'emailAddress' => null,
                ],
                'expectedErrors' => [
                    'username' => "This value should not be blank.",
                    'password' => "This value should not be blank.",
                    'fullName' => "This value should not be blank.",
                    'emailAddress' => "This value should not be blank.",
                ],
            ],
            2 => [
                'params' => [
                    'username' => 'alpha',
                    'password' => '1111',
                    'fullName' => 'Alpha Centauri',
                    'emailAddress' => 'alpha2test.com',
                ],
                'expectedErrors' => [
                    'emailAddress' => "This value is not a valid email address.",
                ],
            ],
        ];
    }
}
