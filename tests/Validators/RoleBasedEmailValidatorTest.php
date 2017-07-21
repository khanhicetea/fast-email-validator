<?php

namespace FastEmailValidator\Tests\Validators;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\Validators\RoleBasedEmailValidator;
use PHPUnit\Framework\TestCase;

class RoleBasedEmailValidatorTest extends TestCase
{
    /**
     * @dataProvider getEmailsDataProvider
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testIsRoleBasesEMail($emailAddress, $expectedResult)
    {
        $roleBasedEmailValidator = new RoleBasedEmailValidator();
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $roleBasedEmailValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            ['info@email.com', true],
            ['support@yahoo.com', true],
            ['contact@hotmail.com', true],
            ['accounts@apple.com', true],
            ['brian.mcgee@something.com', false],
            ['john.johnson@anonfreeemailservice.com', false],
            ['somerandom.name@reddit.com', false],
        ];
    }
}
