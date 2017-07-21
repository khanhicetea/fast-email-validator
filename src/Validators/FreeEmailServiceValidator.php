<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\Utils;
use FastEmailValidator\EmailAddress;
use FastEmailValidator\Data\FreeEmailProviders;

class FreeEmailServiceValidator implements ValidatorInterface
{
    private $data;

    public function __construct($data = null) {
        $this->data = $data ?: new FreeEmailProviders();
    }

    public function getValidatorName(): string
    {
        return 'free_email_provider';
    }

    public function validate(EmailAddress $email): bool {
        return Utils::checkPropertyExists($email->getHostPart(), $this->data);
    }
}
