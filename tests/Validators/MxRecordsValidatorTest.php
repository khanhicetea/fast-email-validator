<?php

namespace FastEmailValidator\Tests\Validators;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\Validators\MxRecordsValidator;
use PHPUnit\Framework\TestCase;

class MxRecordsValidatorTest extends TestCase
{
    /**
     * @dataProvider getEmailsDataProvider
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testValidate($emailAddress, $expectedResult)
    {
        $mxRecordsValidator = new MxRecordsValidator();
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $mxRecordsValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            ['khanhicetea@gmail.com', true],
            ['khanhicetea@yahoo.com', true],
            ['khanhicetea@gmx.com', true],
            ['hi@www.khanhicetea.com', false],
        ];
    }
}
