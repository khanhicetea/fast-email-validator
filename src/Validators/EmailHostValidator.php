<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\EmailAddress;

class EmailHostValidator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_host';
    }

    public function validate(EmailAddress $email): bool {
        $hostPart = $email->getHostPart();
        return $hostPart !== gethostbyname($hostPart);
    }
}
