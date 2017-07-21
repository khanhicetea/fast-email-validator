<?php

declare(strict_types=1);

namespace FastEmailValidator;

use FastEmailValidator\Validators\ValidatorInterface;

class EmailValidator
{
    private $registeredValidators = [];

    public function registerValidator(ValidatorInterface $validator): EmailValidator
    {
        $this->registeredValidators[$validator->getValidatorName()] = $validator;

        return $this;
    }

    public function registerEmailValidatorProvider(EmailValidatorProvider $provider): EmailValidator
    {
        foreach ($provider->getValidators() as $validator) {
            $this->registerValidator($validator);
        }
        return $this;
    }

    public function getRegisteredValidators() {
        return $this->registeredValidators;
    }

    public function validate(EmailAddress $email): array {
        $result = [];

        foreach ($this->registeredValidators as $name => $validator) {
            $result[$name] = $email->isValidEmailAddressFormat() ? $validator->validate($email) : false;
        }

        return $result;
    }
}
