# Mail Queue
A middleware for queing emails in WebFiori.

The aim of this class library is to provide a middleware which will be executed after the request is processed by the application. This will reduce wait time before the application sends the response.

## Classes
* [MailQueue](https://github.com/OSHCO/mail-queue/blob/main/oshco/middleware/MailQueue.php): The core class of th library.

## Usage

### Registering the Middleware

First step in using the middleware is to register it under your WebFiori Application. To register the middleware, modify the code on the class `[APP_DIR]\ini\InitMiddleware` as follows:

``` php
use oshco\middleware\MailQueue;
use webfiori\framework\middleware\MiddlewareManager;

class InitMiddleware {
    public static function init() {
        MiddlewareManager::register(MailQueue::get());
    }
}
```

### Using The Middleware

The messages that will be registered must be of type `webfiori\email\Email`. Following code snippit shows a basic use case.

``` php
$mail1 = new Email($sendAccount);
$mail1->addTo('someoneh@example.com');
MailQueue::enqueue(mail1)
```

## License
The library is licensed under MIT license.
