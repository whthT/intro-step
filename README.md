# IntroStep

A package for make intro on laravel.

## Purpose

Make intro on laravel with a panel.

### Installing

###### Step 1
Install composer package to your project.
with this command
```php
composer require whtht/intro-step
```
###### Step 2
Vendor publishing with this code.
```php
php artisan vendor:publish --force --provider=Whtht\IntroStep\IntroStepServiceProvider
```
###### Step 3
Go to `config/intro-step.php` and edit as 

```php
// web_middleware => /intro-step-admin page middlewares
// api_middleware => Api middlewares
// user_table => Your user table name
// user_column => Your user relationship column
// user_model => Your user model path
```
and
```
php artisan config:cache
```
###### Step 4
```php
php artisan migrate
```

###### Step 5
Append `providers` array in `config/app.php`
```php
\Whtht\IntroStep\IntroStepServiceProvider::class,
```

###### Step 6
Append `aliases` array in `config/app.php`
```php
"IntroStep" => Whtht\IntroStep\Facade\IntroStep::class,
```

###### Step 7
Recache your configs with intro-step configs in your terminal
```php
php artisan config:cache
```
and go to `app/Http/Middlewares/VerifyCsrfToken.php` and add this

```php
protected $except = [
    //...
    "intro-step-admin/*"
];
```



###### Step 8
Append this `@intro_step` blade directive on your layout blade or any blade like this.
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/blade-directive.png"></p>
And clear view cache with `php artisan view:clear`

###### Step 9
Now you ready to go on your `http://yourwebsite.com/intro-step-admin` page
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/step-list.png"></p>
Now lets create a step
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/create-new-step.png"></p>

Example Edit Page about how this fields must be fill
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/edit-step.png"></p>

###### Step 10
Change view render function on controller `view()` to `IntroStep::viewWithIntro()` like this
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/view-with-intro.png"></p>

###### Step 11
Go to this step url `(/home this example)` and see this steps
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/home-blade-code.png"></p>
<p><img src="https://github.com/whthT/intro-step/blob/master/src/docs/home-blade.png"></p>

## License

This project is licensed under the MIT License.
