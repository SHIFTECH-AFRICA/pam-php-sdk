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
  <a href="https://pam.easyncpay.com/docs"><img src="https://github.com/dev-techguy/TechGuy/blob/master/doc.png" width="200"></a>
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

```bash
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/pam.php* for your own configurations:

```bash
# run this to get the configuration file at config/pam.php <-- read through it -->
php artisan vendor:publish --provider="PAM\PAMServiceProvider"
```

A *config/.php* file will be created, follow the example below to define your own configurations.

```dotenv
# set your account secret key api token
PAM_API_TOKEN=check_on_api_profile
PAM_APP_SHORTCODE_SECRET_KEY=check_on_the_app_pay_bill
```

## Usage

Follow the steps below on how to use the pam-php-sdk:

#### How to use the Library

How to use the pam-php-sdk to initiate different levels of *api's*

```php
        use PAM\API\B2C;
        use PAM\API\PayLoad;
        use PAM\API\RegC2bUrl;
        use PAM\API\ShortCode;
        use PAM\API\App;
        use PAM\API\STKPush;
        use PAM\API\Balance;
        
        /**
         * Fetch all your shortcodes
         */
        (new ShortCode())->index();

        /**
         * Get details of one shortcode
         * by passing the id
         */
        (new ShortCode())->show('id');

        /**
         * Fetch all your apps
         */
        (new App())->index();

        /**
         * Get details of one app
         * by passing the id
         */
        (new App())->show('id');

        /**
         * Fetch max <= 1000 latest transactions
         */
        (new PayLoad())->index();

        /**
         * Get details of one payload
         * by passing the id
         */
        (new PayLoad())->show('id');

        /**
         * get the validate shortcode
         * @return mixed
         */
        (new ShortCode())->validate([
            "ConsumerKey" => "",
            "ConsumerSecret" => "",
            "Environment" => "" // sandbox or production
        ]);

        /**
         * get the initiate stk
         * push
         * @return mixed
         */
        (new STKPush())->initiateSTK([
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
        (new RegC2bUrl())->registerC2BURL([
            "Secret" => ""
        ]);

        /**
         * check paybill/till balance
         * @return JsonResponse|mixed
         */
        (new Balance())->checkBalance([
            "Secret" => ""
        ]);

        /**
         * process the b2c transaction
         * here
         * @return mixed
         */
        (new B2C())->initiateB2C([
            "CallingCode" => "", // 254 or 255
            "Secret" => "",
            "TransactionType" => "", // SalaryPayment or BusinessPayment or PromotionPayment
            "PhoneNumber" => "",
            "Amount" => "",
            "ResultUrl" => "",
            "Description" => ""
        ]);

        /**
         * process the stk payment confirmation
         * here
         * @return mixed
         */
        return (new ConfirmPayment())->stkPayment([
            "Secret" => "",// secret for handling stk transactions
            "ReferenceNumber" => "", // the transaction number used for initiating the payment.
            "ResultUrl" => "", // url to receive the payment status
        ]);
        
            /**
             * process the withdrawal confirmation
             * here
             * @return mixed
             */
            return (new ConfirmPayment())->withdrawPayment([
                "Secret" => "", // secret for handling b2c transactions
                "ReferenceNumber" => "", // the transaction number used for initiating the payment.
                "ResultUrl" => "", // url to receive the payment status
            ]);
```

## API Responses

These are the responses that one expects from each api requests.

### PayBill/ShortCode Credentials Validation

```php

   # Sample 200 response
    "data": {
        "Message": "The m-pesa app keys are valid."
    },
    "success": true

```

### Register C2B URL (confirm/validation)

```php

     # Sample 200 response
    "data": {
        "Message": "Validation and Confirmation URLs are already registered"
    },
    "success": true

```

### Balance Response

```php

     # Sample 200 response
    "data": {
        "Number": XXXXX,
        "Balance": 38,000.00
    },
    "success": true

```

### STK-PUSH/C2B LIPA NA M-PESA

```php

    # This the response for making a successful request
    "data": {
        "Message": "Request accepted for processing...",
        "ReferenceNumber": "2BONOSBBTN"
    }
    "success": true

    # stk successful payment done.
    "data": {
        "Success": true,
        "Description": "The service request is processed successfully.",
        "ReferenceNumber": "2BONOSBBTN",
        "PhoneNumber": "254XXXXXXXXX",
        "MpesaReceiptNumber": "PBO2ZOBY44",
        "Amount": 20000
    }

    # c2b/lipa na mpesa successful payment done.
    "data": {
        "Success": true,
        "Description": "The service request is processed successfully.",
        "ReferenceNumber": "2BONOSBBTN",
        "PhoneNumber": "254XXXXXXXXX",
        "MpesaReceiptNumber": "PBO2ZOBY44",
        "Amount": 20000,
        'TransactionType': 'Pay Bill'
        'OrgAccountBalance': 50000,
        'ShortCode':xxxxxx
    }

    # stk/c2b payment not done
    "data": {
        "Success": false,
        "Description": "Request cancelled by user",
        "ReferenceNumber": "2BOXRDNMLU",
        "PhoneNumber": "254XXXXXXXXX"
    }
    
    # This the response for checking stk push payment - similar to mpesa stk push query
    "data": {
        "Message": "Accepted for processing..."
    }
    "success": true
    
    # stk push payment confirmation callback...
    "data": {
        "Success": true or false,
        "Description": "The service request is processed successfully.",
        "ReferenceNumber": "2BONOSBBTN",
        "PhoneNumber": "254XXXXXXXXX",
        "MpesaReceiptNumber": "PBO2ZOBY44",
        "Amount": 20000
    }

```

### B2C/BULK PAYMENT

```php

    # This the response for making a successful request
    "data": {
        "Message": "Request accepted for processing...",
        "ReferenceNumber": "2BO6BCTLYF"
    },
    "success": true

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
     
    # This the response for checking withdrawal payment
    "data": {
        "Message": "Accepted for processing..."
    }
    "success": true
    
    # withdrawal payment confirmation callback...
    "data": {
       'Success' => true or false,
       'Description' => 'Salary payment',
       'ReferenceNumber' => '2BO6BCTLYF',
       'PhoneNumber' => '254XXXXXXXXX',
       'MpesaReceiptNumber' => 'PBO2ZOBY44',
       'Amount' => 50000,
       'B2CUtilityAccountAvailableFunds' => 70000,
       'B2CWorkingAccountAvailableFunds' => 70000,
       'B2CChargesPaidAccountAvailableFunds' => 70000
    }

```

## Version Guidance

| Version | Status | Packagist                    | Namespace | Repo                                                                         |
| ------- | ------ | ---------------------------- | --------- |------------------------------------------------------------------------------|
| 1.x     | Latest | `shiftechafrica/pam-php-sdk` | `PAM`     | [v1.4.9](https://github.com/SHIFTECH-AFRICA/pam-php-sdk/releases/tag/v1.4.9) |

[pam-php-sdk-repo]: https://github.com/SHIFTECH-AFRICA/pam-php-sdk.git

## Security Vulnerabilities

For any security vulnerabilities, please email to [Shiftech Africa](mailto:bugs@shiftech.co.ke).

## License

This package is open-source, licensed under the [MIT License](https://opensource.org/licenses/MIT).
