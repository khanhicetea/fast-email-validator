<?php

declare(strict_types=1);

namespace FastEmailValidator;

use FastEmailValidator\Validators\EmailHostValidator;
use FastEmailValidator\Validators\MxRecordsValidator;
use FastEmailValidator\Validators\ValidFormatValidator;
use FastEmailValidator\Validators\RoleBasedEmailValidator;
use FastEmailValidator\Validators\DisposableEmailValidator;
use FastEmailValidator\Validators\FreeEmailServiceValidator;

class DefaultEmailValidatorProvider extends EmailValidatorProvider
{
    public function __construct() {
        $this->registerValidator(new ValidFormatValidator());
        $this->registerValidator(new DisposableEmailValidator());
        $this->registerValidator(new EmailHostValidator());
        $this->registerValidator(new FreeEmailServiceValidator());
        $this->registerValidator(new MxRecordsValidator());
        $this->registerValidator(new RoleBasedEmailValidator());
    }
}
