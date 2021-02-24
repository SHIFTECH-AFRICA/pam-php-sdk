# <p align="center"><a href="https://pam.easyncpay.com" target="_blank"><img width="200" src="https://pam.easyncpay.com/img/logo.png"></a></p>

<p align="center">
  <b>Easy Money Manager</b><br>
  <a href="https://github.com/SHIFTECH-AFRICA/pam-php-sdk/issues">
  <img src="https://img.shields.io/github/issues/SHIFTECH-AFRICA/pam-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/pam-php-sdk/network/members">
  <img src="https://img.shields.io/github/forks/SHIFTECH-AFRICA/pam-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/pam-php-sdk/stargazers">
  <img src="https://img.shields.io/github/stars/SHIFTECH-AFRICA/pam-php-sdk.svg">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/pam-php-sdk">
  <img src="https://poser.pugx.org/shiftechafrica/pam-php-sdk/v/stable">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/pam-php-sdk">
  <img src="https://poser.pugx.org/shiftechafrica/pam-php-sdk/downloads">
  </a>
  <br><br>
  <img src="https://pam.easyncpay.com/img/about/circle.png" width="200">
</p>

## Introduction
This library handles all the PAM - PayBill Account Manager API's,that are then linked to Safaricom M-pesa Portals.

## Installing

The recommended way to install pam-php-sdk is through
[Composer](http://getcomposer.org).

```bash
# Install package via composer
composer require shiftechafrica/pam-php-sdk
```

Next, run the Composer command to install the latest stable version of *shiftechafrica/pam-php-sdk*:

```bash
# Update package via composer
 composer update shiftechafrica/pam-php-sdk --lock
```

After installing, the package will be auto discovered, But if need you may run:

```php
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/pam.php* for your own configurations:

```php
# run this to get the configuration file at config/pam.php <-- read through it -->
php artisan vendor:publish --provider="PAM\PAMServiceProvider"
```
A *config/.php* file will be created, follow the example below to define your own configurations.

```php
# set your account secret key
PAM_API_TOKEN=
```

## Usage
Follow the steps below on how to use the pam-php-sdk:

#### How to use the Library
How to use the pam-php-sdk to initiate different levels of *api's*

```php
        /**
         * Fetch all your shortcodes
         */
        return (new ShortCode())->index();


        /**
         * Get details of one shortcode
         * by passing the id
         */
        return (new ShortCode())->show('id');


        /**
         * Fetch all your apps
         */
        return (new App())->index();


        /**
         * Get details of one app
         * by passing the id
         */
        return (new App())->show('id');


        /**
         * get the validate shortcode
         * @return mixed
         */
        return (new ShortCode())->validate([
            "ConsumerKey" => "",
            "ConsumerSecret" => "",
            "Environment" => "" // sandbox or production
        ]);


        /**
         * get the initiate stk
         * push
         * @return mixed
         */
        return (new STKPush())->initiateSTK([
            "CallingCode" => "", // 254 or 255
            "Secret" => "",
            "TransactionType" => "", // CustomerPayBillOnline or CustomerBuyGoodsOnline
            "PhoneNumber" => "",
            "Amount" => "",
            "ResultUrl" => "",
            "Description" => ""
        ]);


        /**
         * register c2b url for lipa_na_mpesa
         * @return JsonResponse|mixed
         */
        return (new RegC2bUrl())->registerC2BURL([
            "Secret" => ""
        ]);


        /**
         * process the b2c transaction
         * here
         * @return mixed
         */
        return (new B2C())->initiateB2C([
            "CallingCode" => "", // 254 or 255
            "Secret" => "",
            "TransactionType" => "", // SalaryPayment or BusinessPayment or PromotionPayment
            "PhoneNumber" => "",
            "Amount" => "",
            "ResultUrl" => "",
            "Description" => ""
        ]);
```

## API Responses
This are the responses that one expects from each api requests.

### PayBill/ShortCode Credentials Validation
```php

   # Sample 200 response
     "data": {
        "Message": "The m-pesa app keys are valid."
    }

```

### Register C2B URL (confirm/validation)
```php

     # Sample 200 response
    "data": {
        "Message": "Validation and Confirmation URLs are already registered"
    }

```

### STK-PUSH/C2B LIPA NA M-PESA
```php

    # This the response for making a successful request
    "data": {
        "Message": "Request accepted for processing...",
        "ReferenceNumber": "2BONOSBBTN"
    }

    # stk/c2b successful payment done.
    "data": {
        "Success": true,
        "Description": "The service request is processed successfully.",
        "ReferenceNumber": "2BONOSBBTN",
        "PhoneNumber": "254XXXXXXXXX",
        "MpesaReceiptNumber": "PBO2ZOBY44",
        "Amount": 20000
    }

    # stk/c2b payment not done
    "data": {
        "Success": false,
        "Description": "Request cancelled by user",
        "ReferenceNumber": "2BOXRDNMLU",
        "PhoneNumber": "254XXXXXXXXX"
    }

```


### B2C/BULK PAYMENT
```php

    # This the response for making a successful request
    "data": {
        "Message": "Request accepted for processing...",
        "ReferenceNumber": "2BO6BCTLYF"
    },

    # b2c successful withdraw payment done.
    "data": {
       'Success' => true,
       'Description' => 'Salary payment',
       'ReferenceNumber' => '2BO6BCTLYF',
       'PhoneNumber' => '254XXXXXXXXX',
       'MpesaReceiptNumber' => 'PBO2ZOBY44',
       'Amount' => 50000,
       'B2CUtilityAccountAvailableFunds' => 70000,
       'B2CWorkingAccountAvailableFunds' => 70000,
       'B2CChargesPaidAccountAvailableFunds' => 70000
    }

    # b2c withdraw payment not done.
    "data": {
        "Success": false,
        "Description": "The initiator information is invalid.",
        "ReferenceNumber": "2BO6BCTLYF",
        "PhoneNumber": "254XXXXXXXXX"
    }

```

## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                |
|---------|------------|---------------------|--------------|---------------------|
| 1.x     | Latest     | `shiftechafrica/pam-php-sdk` | `PAM` | [v1.3.5](https://github.com/SHIFTECH-AFRICA/pam-php-sdk/releases/tag/v1.3.5)|

[pam-php-sdk-repo]: https://github.com/SHIFTECH-AFRICA/pam-php-sdk.git

## Security Vulnerabilities
 For any security vulnerabilities, please email to [Shiftech Africa](mailto:bugs@shiftech.co.ke).
 
## License
 This package is open-source, licensed under the [MIT License](https://opensource.org/licenses/MIT).
