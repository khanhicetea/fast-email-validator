**Fast email validation library for PHP 7+**

Inspired by [daveearley's Email-Validation-Tool](https://github.com/daveearley/Email-Validation-Tool)

The aim of this library is to offer a more detailed email validation report than simply checking if an email is the valid format, and also to make it possible to easily add custom validations.

Currently this tool checks the following:


| Validation  | Description |
| ------------- | ------------- |
| MX records  | Checks if the email's domain has valid MX records  |
| Valid format  | Validates e-mail addresses against the syntax in RFC 822, with the exceptions that comments and whitespace folding and dotless domain names are not supported (as it uses PHP's filter_var().  |
| Email Host  | Checks if the email's host (e.g gmail.com) is reachable  |
| Role/Business Email^  | Checks if the email is a role/business based email (e.g info@reddit.com).  |
| Disposable email provider^  | Checks if the email is a disposable email (e.g person@10minutemail.com).  |
| Free email provider^  | Checks if the email is a free email (e.g person@yahoo.com).  |

^ **Data used for these checks can be found [here](https://github.com/khanhicetea/fast-email-validator/tree/master/src/data)**

# Installation

```bash
composer require khanhicetea/fast-email-validator
```

# Usage
## Quick Start

```php
// Include the composer autoloader
require __DIR__ . '/vendor/autoload.php';

use FastEmailValidator\EmailAddress;
use FastEmailValidator\EmailValidatorProvider;
use FastEmailValidator\EmailValidator;

$fastEmailValidator = new EmailValidator();

$provider = new EmailValidatorProvider();
$provider->registerValidator(new ValidFormatValidator());
$provider->registerValidator(new DisposableEmailValidator());
$provider->registerValidator(new EmailHostValidator());
$provider->registerValidator(new FreeEmailServiceValidator());
$provider->registerValidator(new MxRecordsValidator());
$provider->registerValidator(new RoleBasedEmailValidator());

$fastEmailValidator->registerEmailValidatorProvider($provider);

$result = $fastEmailValidator->validate(new EmailAddress('hi@khanhicetea.com'));

echo(json_encode($result));

```

Expected output:

```json
{
  "valid_format": true,
  "disposable_email_provider": false,
  "valid_host": true,
  "free_email_provider": false,
  "valid_mx_records": true,
  "role_or_business_email": true
}
```

# FAQ

### Is this validation accurate?
No, none of these tests are 100% accurate. As with any email validation there will always be false positives & negatives. The only way to guarantee an email is valid is to send an email and solicit a response. However, this library is still useful for detecting disposable emails etc., and also acts as a good first line of defence.
