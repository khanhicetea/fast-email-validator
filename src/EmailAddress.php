<?php

declare(strict_types=1);

namespace FastEmailValidator;

class EmailAddress
{
    private $namePart;
    private $hostPart;
    private $emailAddress;
    private $valid;

    public function __construct(string $email)
    {
        $parts = explode('@', $email);
        $this->namePart = $parts[0] ?? '';
        $this->hostPart = $parts[1] ?? '';
        $this->emailAddress = $this->namePart.'@'.$this->hostPart;
        $this->valid = ($this->namePart == '' || $this->hostPart == '') ? false : null;
    }

    public function getNamePart(): string
    {
        return $this->namePart;
    }

    public function getHostPart(): string
    {
        return $this->hostPart;
    }

    public function getTopLevelDomainPart(): string
    {

        return explode('.', $this->hostPart)[1] ?? '';
    }

    public function isValidEmailAddressFormat(): bool
    {
        if ($this->valid === null) {
            $this->valid = filter_var($this->emailAddress, FILTER_VALIDATE_EMAIL) !== false;
        }
        return $this->valid;
    }

    public function __toString(): string
    {
        return $this->emailAddress;
    }
}
