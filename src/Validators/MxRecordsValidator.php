<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\EmailAddress;

class MxRecordsValidator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_mx_records';
    }

    public function validate(EmailAddress $email): bool {
        return checkdnsrr($email->getHostPart(), 'MX');
    }
}
