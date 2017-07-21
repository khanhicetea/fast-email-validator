<?php

namespace FastEmailValidator\Tests;

use FastEmailValidator\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    const VALID_TEST_EMAIL = 'hi@khanhicetea.com';
    const INVALID_TEST_EMAIL = 'hi----khanhicetea.com';

    /** @var EmailAddress */
    private $validEmail;

    /** @var EmailAddress */
    private $invalidEmail;

    protected function setUp()
    {
        $this->validEmail = new EmailAddress(self::VALID_TEST_EMAIL);
        $this->invalidEmail = new EmailAddress(self::INVALID_TEST_EMAIL);
    }

    public function testAsString()
    {
        $this->assertSame(self::VALID_TEST_EMAIL, (string) $this->validEmail);
    }

    public function testGetHostPart()
    {
        $this->assertSame('khanhicetea.com', $this->validEmail->getHostPart());
    }

    public function testGetTldPart()
    {
        $this->assertSame('com', $this->validEmail->getTopLevelDomainPart());
    }

    public function testGetNamePart()
    {
        $this->assertSame('hi', $this->validEmail->getNamePart());
    }

    public function testGetHostPartForInvalidEmail()
    {
        $this->assertSame('', $this->invalidEmail->getHostPart());
    }

    public function testGetTldPartForInvalidEmail()
    {
        $this->assertSame('', $this->invalidEmail->getTopLevelDomainPart());
    }

    public function testGetNamePartForInvalidEmail()
    {
        $this->assertSame('hi----khanhicetea.com', $this->invalidEmail->getNamePart());
    }

    public function testIsValidFormat()
    {
        $this->assertTrue($this->validEmail->isValidEmailAddressFormat());
    }

    public function testIsValidFormatForInvalidEmail()
    {
        $this->assertFalse($this->invalidEmail->isValidEmailAddressFormat());
    }
}
