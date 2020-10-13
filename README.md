# <p align="center"><a href="https://pam.easyncpay.com" target="_blank"><img width="200" src="https://pam.easyncpay.com/img/logo.png"></a></p>

<p align="center">
  <b>Easy Money Manager</b><br>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/issues">
  <img src="https://img.shields.io/github/issues/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/network/members">
  <img src="https://img.shields.io/github/forks/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/stargazers">
  <img src="https://img.shields.io/github/stars/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://packagist.org/packages/dev-techguy/laravel-multiple-guards">
  <img src="https://poser.pugx.org/dev-techguy/laravel-multiple-guards/v/stable">
  </a>
  <a href="https://packagist.org/packages/dev-techguy/laravel-multiple-guards">
  <img src="https://poser.pugx.org/dev-techguy/laravel-multiple-guards/downloads">
  </a>
  <br><br>
  <img src="https://pam.easyncpay.com/images/undraw_investing_7u74.svg">
</p>

## Introduction
This library handles all the PAM - PayBill Account Manager API's,that are then linked to Safaricom M-pesa Daraja.

## Installing

The recommended way to install laravel-multiple-guards is through
[Composer](http://getcomposer.org).

```bash
# Install package via composer
composer require dev-techguy/laravel-multiple-guards
```

Next, run the Composer command to install the latest stable version of *dev-techguy/laravel-multiple-guards*:

```bash
# Update package via composer
 composer update dev-techguy/laravel-multiple-guards --lock
```

After installing, the package will be auto discovered, But if need you may run:

```php
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/laravel-multiple-guards.php* for your own configurations:

```php
# run this to get the configuration file at config/laravel-multiple-guards.php <-- read through it -->
php artisan vendor:publish --provider="LaravelMultipleGuards\LaravelMultipleGuardsServiceProvider"
```
A *config/laravel-multiple-guards.php* file will be created, follow the example below to define your guards.

```php
# set all the guards to use within the system
SYSTEM_GUARDS=admin,web
```

## Usage
Follow the steps below on how to use the laravel-multiple-guards:

#### How to use the Library
How to use the guards within your controller...

```php
class HomeController extends Controller
{
    use FindGuard;
    
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware($this->setGuardMiddleware()); //@todo this sets the middleware automatically i.e auth, auth:admin that you have defined in the config/auth.php
        }
    
        /**
         * Show the application dashboard.
         *
         * @return Renderable
         */
        public function index()
        {
            return view('home');
        }
    
        /**
         * get authenticated user
         */
        public function getUser()
        {
            return $this->findGuardType()->user();
        }
    
        /**
         * logout user
         * @return RedirectResponse
         */
        public function logout()
        {
            $this->findGuardType()->logout();
            return redirect()->route('login');
        }
}

/**
 * How to get the guard name
 * authorized
*/
 return $this->findGuardType(true); //@todo this returns the guard name i.e web , admin
```

## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                |
|---------|------------|---------------------|--------------|---------------------|
| 1.x     | Latest     | `dev-techguy/laravel-multiple-guards` | `LaravelMultipleGuards` | [v1.1.2](https://github.com/dev-techguy/laravel-multiple-guards/releases/tag/v1.1.2)|

[laravel-multiple-guards-repo]: https://github.com/dev-techguy/laravel-multiple-guards.git

## Security Vulnerabilities
 For any security vulnerabilities, please email to [Vincent Ososi](mailto:vincent@shiftech.co.ke).
 
## License
 This package is open-source, licensed under the [MIT License](https://opensource.org/licenses/MIT).
