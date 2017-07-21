<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\EmailAddress;

interface ValidatorInterface
{
    public function validate(EmailAddress $email): bool;
    public function getValidatorName(): string;
}
