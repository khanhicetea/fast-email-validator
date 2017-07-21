<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\Utils;
use FastEmailValidator\EmailAddress;
use FastEmailValidator\Data\RoleBasedEmailPrefixes;

class RoleBasedEmailValidator implements ValidatorInterface
{
    private $data;

    public function __construct($data = null) {
        $this->data = $data ?: new RoleBasedEmailPrefixes();
    }

    public function getValidatorName(): string
    {
        return 'role_or_business_email';
    }

    public function validate(EmailAddress $email): bool {
        return Utils::checkPropertyExists($email->getNamePart(), $this->data);
    }
}
