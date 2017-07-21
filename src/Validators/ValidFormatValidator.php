<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\EmailAddress;

class ValidFormatValidator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_format';
    }

    public function validate(EmailAddress $email): bool
    {
        return $email->isValidEmailAddressFormat();
    }
}
