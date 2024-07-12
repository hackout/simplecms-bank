<?php

namespace SimpleCMS\Bank\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection getBankList()
 * @method static \SimpleCMS\Bank\Packages\BankModel|null getBankByCode(string $code)
 * @method static \SimpleCMS\Bank\Packages\BankModel|null getBankByName(string $name)
 * @method static \SimpleCMS\Bank\Packages\BankModel|null getBankByBin(string $bin)
 * @method static \SimpleCMS\Bank\Packages\BankModel|null getBankByCardNumber(string $cardNumber)
 * @method static bool checkBin(string $bin)
 * @method static bool checkCardNumber(string $bin)
 * @method static \Illuminate\Support\Collection<value:string,name:string> getOptions(string $type = 'all')
 * 
 * @see \SimpleCMS\Bank\Packages\Bank
 */
class Bank extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bank';
    }
}
