<?php

declare(strict_types=1);

namespace FastEmailValidator;
use FastEmailValidator\Validators\ValidatorInterface;

class EmailValidatorProvider
{
    private $validators = [];

    public function registerValidator(ValidatorInterface $validator): EmailValidatorProvider {
        $this->validators[] = $validator;
        return $this;
    }

    public function getValidators(): array {
        return $this->validators;
    }
}
