# Laravel Bank组件

📦 一个涵盖银联公布的260个银行的相关信息。

简体中文 | [English](/README.md)

[![Latest Stable Version](https://poser.pugx.org/simplecms/bank/v/stable.svg)](https://packagist.org/packages/simplecms/bank) [![Latest Unstable Version](https://poser.pugx.org/simplecms/bank/v/unstable.svg)](https://packagist.org/packages/simplecms/bank) [![Code Coverage](https://scrutinizer-ci.com/g/overtrue/easy-sms/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/hackout/simplecms-bank/?branch=master) [![Total Downloads](https://poser.pugx.org/simplecms/bank/downloads)](https://packagist.org/packages/simplecms/bank) [![License](https://poser.pugx.org/simplecms/bank/license)](https://packagist.org/packages/simplecms/bank)

## 环境需求

- PHP >= 8.0
- [Laravel/Framework](https://packagist.org/packages/laravel/framework) >= 9.0

## 安装

```bash
composer require simplecms/bank
```

## 使用方法

内置了Validation Rule 和 safe_bank_number方法。

### 获取银行列表

```php
use SimpleCMS\Bank\Facades\Bank; 

Bank::getBankList(); //返回完整列表
Bank::getOptions(); // 返回为Collection<value:string,name:string>
Bank::getOptions('DC'); // 返回贷记卡银行列表 支持 all，DC，CC，SCC，PC
```

### 查询及检查

```php
use SimpleCMS\Bank\Facades\Bank; 

Bank::getBankByCode($code); //通过代码查询银行信息
Bank::getBankByName($name); // 通过名称查询银行
Bank::getBankByBin($bin); // 通过BIN查询银行
Bank::getBankByCardNumber($card_number); // 通过卡号查询银行
Bank::checkBin($bin); // 检查Bin有效性
Bank::checkCardNumber($card_number); // 检查卡号有效性
```

### Helpers

```php
$card_number = '62270000000006666';
//银行卡掩码
safe_bank_number((string) $card_number, (string) $maskChar = '*', (int) $start = 6, (int) $length = 4); // 622700********6666

```

### Validation

```php
$rules = [
    'bank' => 'bank', //银行名称
    'bank_bin' => 'bank_bin', //银行BIN
    'bank_card' => 'bank_card', //银行卡号
    'bank_code' => 'bank_code' //银行代码
];
$messages = [
    'bank.bank' => '银行名称不正确',
    'bank_bin.bank_bin' => 'BIN码不正确',
    'bank_card.bank_card' => '卡号不正确',
    'bank_code.bank_code' => '银行代码不正确',
];
$data = $request->validate($rules,$messages);
```

## 自定义银行数据

你可以通过```.env```自定义自己的数据。

### 修改配置文件路径

在```.env```增加以下代码:

```bash
BANK_PATH='你的银行json文件地址' #绝对位置
```

### JSON数据格式

数据结构参考遵循以下格式:

```bash
{
    "name": "银行名称",
    "code": "银行代码标识",
    "bins": {
        "DC": {  #DC 储蓄卡
            "19": ["123456","23456"] # 19为卡号长度，数字内容为bin码
        },
        "CC": {  #CC 信用卡
            "18": ["32131","13123"]
        },
        "SCC": { #准贷记卡
            "16": ["1233","2345"],
            "17": ["3213","3322"]
        },
        "PC": { #预付费卡
            "15": ["1234"]
        }
    }
}
```

## License

MIT
