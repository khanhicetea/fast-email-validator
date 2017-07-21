<?php

namespace FastEmailValidator\Tests;

use FastEmailValidator\EmailValidatorProvider;
use FastEmailValidator\Validators\MxRecordsValidator;
use FastEmailValidator\Validators\ValidFormatValidator;
use PHPUnit\Framework\TestCase;

class EmailDataProviderTest extends TestCase
{
    /** @var EmailValidatorProvider  */
    private $emailDataProvider;

    protected  function setUp()
    {
        $this->emailDataProvider = new EmailValidatorProvider();
    }

    private function getValidators() {
        return [
            new ValidFormatValidator(),
            new MxRecordsValidator(),
        ];
    }

    public function testRegisterValidator()
    {
        $validators = $this->getValidators();

        foreach ($validators as $validator) {
            $this->emailDataProvider
                ->registerValidator($validator);
        }

        $this->assertSame($validators, $this->emailDataProvider->getValidators());
    }

    public function testGetValidators()
    {
        $validators = $this->getValidators();

        foreach ($validators as $validator) {
            $this->emailDataProvider
                ->registerValidator($validator);
        }

        $this->assertSame($validators, $this->emailDataProvider->getValidators());
    }
}
