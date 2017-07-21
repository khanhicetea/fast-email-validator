<?php

namespace FastEmailValidator\Tests\Validators;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\Validators\EmailHostValidator;
use PHPUnit\Framework\TestCase;

class EmailHostValidatorTest extends TestCase
{
    /**
     * @dataProvider getEmailsDataProvider
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testValidate($emailAddress, $expectedResult)
    {
        $emailHostValidator = new EmailHostValidator();
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $emailHostValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            ['khanhicetea@gmail.com', true],
            ['khanhicetea@yahoo.com', true],
            ['khanhicetea@something-not-exists.com', false],
            ['khanhicetea@bestvpn.top', true],
            ['khanhicetea@bel.kr', true],
            ['khanhicetea@10minutemail.de', true]
        ];
    }
}
