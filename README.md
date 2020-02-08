# Notifications channel for Laravel 5.3+

## Contents

- [Installation](#installation)
	- [Setting up your account](#setting-up-your-account)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/vfirst
```

### Setting up your account

Add your configuration to your `config/services.php`:

```php
// config/services.php
...
'vfirst' => [
    'username' => env('VFIRST_USERNAME'), // optional when using auth token
    'password' => env('VFIRST_PASSWORD'), // optional when using auth token
    'from' => env('VFIRST_FROM'), // optional
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Vfirst\SmsChannel;
use NotificationChannels\Vfirst\Message;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    public function toVfirst($notifiable)
    {
        return (new Message())
            ->text("Your {$notifiable->service} account was approved!");
    }
}
```

In order to let your Notification know which phone are you sending to, the channel will look for the `phone_number` attribute and `mobile` of the Notifiable model. If you want to override this behaviour, add the `routeNotificationForVfirst` method to your Notifiable model.

```php
public function routeNotificationForMobtexting()
{
    return '+1234567890';
}
```

### Available Message methods

- `from('')`: Accepts a phone to use as the notification sender.
- `text('')`: Accepts a string value for the notification body.
- `to('')`: Accepts a string value for the notification to (over writes default).

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
