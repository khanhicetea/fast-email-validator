<?php

declare(strict_types=1);

namespace FastEmailValidator\Validators;
use FastEmailValidator\Utils;
use FastEmailValidator\EmailAddress;
use FastEmailValidator\Data\DisposableEmails;

class DisposableEmailValidator implements ValidatorInterface
{
    private $data;

    public function __construct($data = null) {
        $this->data = $data ?: new DisposableEmails();
    }

    public function getValidatorName(): string
    {
        return 'disposable_email_provider';
    }

    public function validate(EmailAddress $email): bool {
        return Utils::checkPropertyExists($email->getHostPart(), $this->data);
    }
}
