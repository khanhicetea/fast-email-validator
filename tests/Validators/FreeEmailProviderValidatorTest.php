<?php

namespace FastEmailValidator\Tests\Validators;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\Validators\FreeEmailServiceValidator;
use PHPUnit\Framework\TestCase;

class FreeEmailProviderValidatorTest extends TestCase
{
    /**
     * @dataProvider getEmailsDataProvider
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testIsEmailAProvider($emailAddress, $expectedResult)
    {
        $freeEmailProviderValidator = new FreeEmailServiceValidator();
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $freeEmailProviderValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            ['dave@gmail.com', true],
            ['dave@yahoo.com', true],
            ['dave@hotmail.com', true],
            ['dave@something.com', false],
            ['dave@anonfreeemailservice.com', false],
            ['dave@reddit.com', false],
        ];
    }
}
