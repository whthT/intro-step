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
Settings your user table.

<p><img src="https://github.com/whthT/intro-step/blob/1.0.1/docs/config-file.png"></p>

```php
// web_middleware => /intro-step-admin page middlewares
// api_middleware => Api middlewares
// user_table => Your user table name
// user_column => Your user relationship column
// user_model => Your user model path
```

###### Step 4
```php
php artisan migrate --seed
// Create intro_step_settings, intro_step_step_list and intro_step_user_list tables with default options seed.
```

###### Step 5
Append `providers` array in `config/app.php`
```php
\Whtht\IntroStep\IntroStepServiceProvider::class,
```

###### Step 6
Append `aliases` array in `config/app.php`
```php
"IntroStep" => Whtht\IntroStep\IntroStep::class,
```

###### Step 7
Recache your configs with intro-step configs in your terminal
```php
php artisan config:cache
```

###### Step 8
Append this `@intro_step` blade directive on your layout blade or any blade like this.
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/blade-directive.png"></p>
And clear view cache with `php artisan view:clear`

###### Step 9
Now you ready to go on your `http://yourwebsite.com/intro-step-admin` page
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/step-list.png"></p>
Now lets create a step
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/create-new-step.png"></p>

Example Edit Page about how this fields must be fill
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/edit-step.png"></p>

###### Step 10
Change view render function on controller `view()` to `IntroStep::viewWithIntro()` like this
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/view-with-intro.png"></p>

###### Step 11
Go to this step url `(/home this example)` and see this steps
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/home-blade-code.png"></p>
<p><img src="https://github.com/whthT/intro-step/blob/master/docs/home-blade.png"></p>

## License

This project is licensed under the MIT License.
