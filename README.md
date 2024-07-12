
# Laravel Bank Component

📦 A comprehensive collection of information covering 260 banks as published by UnionPay.

English | [简体中文](/README-zhCN.md)

[![Latest Stable Version](https://poser.pugx.org/simplecms/bank/v/stable.svg)](https://packagist.org/packages/simplecms/bank) [![Latest Unstable Version](https://poser.pugx.org/simplecms/bank/v/unstable.svg)](https://packagist.org/packages/simplecms/bank) [![Code Coverage](https://scrutinizer-ci.com/g/overtrue/easy-sms/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/hackout/simplecms-bank/?branch=master) [![Total Downloads](https://poser.pugx.org/simplecms/bank/downloads)](https://packagist.org/packages/simplecms/bank) [![License](https://poser.pugx.org/simplecms/bank/license)](https://packagist.org/packages/simplecms/bank)

## Requirements

- PHP >= 8.0
- [Laravel/Framework](https://packagist.org/packages/laravel/framework) >= 9.0

## Installation

```bash
composer require simplecms/bank
```

## Usage

Includes Validation Rule and safe_bank_number method. 

### Get Bank List

```php
use SimpleCMS\Bank\Facades\Bank; 

Bank::getBankList(); //Returns the complete list
Bank::getOptions(); // Returns as Collection<value:string, name:string>
Bank::getOptions('DC'); // Returns a list of debit card banks. Supports all, DC, CC, SCC, PC
```

### Query and Check

```php
use SimpleCMS\Bank\Facades\Bank; 

Bank::getBankByCode($code); // Retrieve bank information by code
Bank::getBankByName($name); // Retrieve bank information by name
Bank::getBankByBin($bin); // Retrieve bank information by BIN
Bank::getBankByCardNumber($card_number); // Retrieve bank information by card number
Bank::checkBin($bin); // Check the validity of BIN
Bank::checkCardNumber($card_number); // Check the validity of card number
```

### Helpers

```php
$card_number = '62270000000006666';
//Bank card masking
safe_bank_number((string) $card_number, (string) $maskChar = '*', (int) $start = 6, (int) $length = 4); // 622700********6666

```

### Validation

```php
$rules = [
    'bank' => 'bank', //Bank name
    'bank_bin' => 'bank_bin', //Bank BIN
    'bank_card' => 'bank_card', //Bank card number
    'bank_code' => 'bank_code' //Bank code
];
$messages = [
    'bank.bank' => 'The name of bank is incorrect.',
    'bank_bin.bank_bin' => 'The bin code is incorrect.',
    'bank_card.bank_card' => 'The card number is incorrect.',
    'bank_code.bank_code' => 'The code of bank is incorrect.',
];
$data = $request->validate($rules,$messages);
```

## Custom Bank Data

You can customize your own data through the ```.env``` file.

### Modify Configuration File Path

Add the following code to your ```.env``` file:

```bash
BANK_PATH='Your bank JSON file address' #Absolute location
```

### JSON Data Format

The data structure follows the format below:

```bash
{
    "name": "Bank Name",
    "code": "Bank code identifier",
    "bins": {
        "DC": {  # DC Debit Card
            "19": ["123456", "23456"] # 19 is the card number length, numeric content is the BIN code
        },
        "CC": {  # CC Credit Card
            "18": ["32131", "13123"]
        },
        "SCC": { # Semi-Credit Card
            "16": ["1233", "2345"],
            "17": ["3213", "3322"]
        },
        "PC": { # Prepaid Card
            "15": ["1234"]
        }
    }
}
```

## License

MIT
