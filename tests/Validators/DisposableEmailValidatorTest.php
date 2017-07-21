<?php

namespace FastEmailValidator\Tests\Validators;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\Validators\DisposableEmailValidator;
use PHPUnit\Framework\TestCase;

class DisposableEmailValidatorTest extends TestCase
{
    /**
     * @dataProvider getEmailsDataProvider
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testValidate($emailAddress, $expectedResult)
    {
        $disposableFastEmailValidator = new DisposableEmailValidator();
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $disposableFastEmailValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            ['khanhicetea@gmail.com', false],
            ['khanhicetea@yahoo.com', false],
            ['khanhicetea@something.com', false],
            ['khanhicetea@bestvpn.top', true],
            ['khanhicetea@bel.kr', true],
            ['khanhicetea@10minutemail.de', true]
        ];
    }
}
