<?php

namespace FastEmailValidator\Tests;

use FastEmailValidator\EmailAddress;
use FastEmailValidator\EmailValidatorProvider;
use FastEmailValidator\EmailValidator;
use FastEmailValidator\Validators\EmailHostValidator;
use FastEmailValidator\Validators\MxRecordsValidator;
use FastEmailValidator\Validators\ValidFormatValidator;
use FastEmailValidator\Validators\RoleBasedEmailValidator;
use FastEmailValidator\Validators\DisposableEmailValidator;
use FastEmailValidator\Validators\FreeEmailServiceValidator;
use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
    /** @var EmailValidator */
    private $fastEmailValidator;

    /** @var EmailValidatorProvider */
    private $emailValidatorProvider;

    protected function setUp()
    {
        $this->fastEmailValidator = new EmailValidator();
    }

    public function testRegisterValidator() {
        $this->fastEmailValidator->registerValidator(new ValidFormatValidator());

        return $this->assertArrayHasKey('valid_format', $this->fastEmailValidator->getRegisteredValidators());
    }

    public function testGetRegisteredValidators() {
        $validators = [
            'valid_format' => new ValidFormatValidator(),
        ];
        $this->fastEmailValidator->registerValidator($validators['valid_format']);

        return $this->assertSame($validators, $this->fastEmailValidator->getRegisteredValidators());
    }

    public function testRegisterEmailValidatorProvider() {
        $emailValidatorProvider = new EmailValidatorProvider();
        $emailValidatorProvider->registerValidator(new MxRecordsValidator());
        $emailValidatorProvider->registerValidator(new ValidFormatValidator());

        $this->fastEmailValidator->registerEmailValidatorProvider($emailValidatorProvider);

        return $this->assertArrayHasKey('valid_format', $this->fastEmailValidator->getRegisteredValidators());
        return $this->assertArrayHasKey('valid_mx_records', $this->fastEmailValidator->getRegisteredValidators());
    }

    /**
     * @dataProvider getEmailsDataProvider
     * @param mixed $emailAddress
     * @param array $expectedResult
     */
    public function testValidate($emailAddress, $expectedResult) {
        $emailValidatorProvider = new EmailValidatorProvider();
        $emailValidatorProvider->registerValidator(new ValidFormatValidator());
        $emailValidatorProvider->registerValidator(new DisposableEmailValidator());
        $emailValidatorProvider->registerValidator(new EmailHostValidator());
        $emailValidatorProvider->registerValidator(new FreeEmailServiceValidator());
        $emailValidatorProvider->registerValidator(new MxRecordsValidator());
        $emailValidatorProvider->registerValidator(new RoleBasedEmailValidator());

        $this->fastEmailValidator->registerEmailValidatorProvider($emailValidatorProvider);
        $email = new EmailAddress($emailAddress);
        $this->assertSame($expectedResult, $this->fastEmailValidator->validate($email));
    }

    /**
     * @return array
     */
    public function getEmailsDataProvider(): array
    {
        return [
            [
                'khanhicetea@gmail.com',
                [
                    'valid_format' => true,
                    'disposable_email_provider' => false,
                    'valid_host' => true,
                    'free_email_provider' => true,
                    'valid_mx_records' => true,
                    'role_or_business_email' => false,
                ]
            ],
            [
                'staff@github.com',
                [
                    'valid_format' => true,
                    'disposable_email_provider' => false,
                    'valid_host' => true,
                    'free_email_provider' => false,
                    'valid_mx_records' => true,
                    'role_or_business_email' => true,
                ]
            ],
            [
                'wrong---khanhicetea.com',
                [
                    'valid_format' => false,
                    'disposable_email_provider' => false,
                    'valid_host' => false,
                    'free_email_provider' => false,
                    'valid_mx_records' => false,
                    'role_or_business_email' => false,
                ]
            ],
            [
                'a@somethingwrong12345678.com',
                [
                    'valid_format' => true,
                    'disposable_email_provider' => false,
                    'valid_host' => false,
                    'free_email_provider' => false,
                    'valid_mx_records' => false,
                    'role_or_business_email' => false,
                ]
            ],
            [
                'hi@www.github.com',
                [
                    'valid_format' => true,
                    'disposable_email_provider' => false,
                    'valid_host' => true,
                    'free_email_provider' => false,
                    'valid_mx_records' => true,
                    'role_or_business_email' => true,
                ]
            ],
        ];
    }
}
