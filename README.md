# 中国银行列表

涵盖国内外260家银行的bin

## 环境配置要求

1. PHP 8.0+

## 自定义地理数据

在```.env```增加以下代码:

```bash
BANK_PATH='你的银行json文件地址' #绝对位置
```

## 安装

```bash
composer require simplecms/bank
```

## 列表及查询

```php
use SimpleCMS\Bank\Facades\Bank; 
//获取列表
Bank::getOptions(); // 返回为Collection<value:string,name:string>
Bank::getOptions('DC'); // 返回贷记卡银行列表 支持 DC CC SCC PC

```

## 数据结构

数据结构参考遵循以下格式:

```bash
{
    "name": "银行名称",
    "code": "银行代码标识",
    "bins": {
        "DC": {  #DC 储蓄卡
            19: ["123456","23456"] # 19为卡号长度，数字内容为bin码
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

## Facades

```php
use SimpleCMS\Bank\Facades\Bank; #银行卡列表 
```

## 其他说明

更多操作参考IDE提示
