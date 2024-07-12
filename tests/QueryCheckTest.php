<?php
namespace SimpleCMS\Bank\Tests;

use SimpleCMS\Bank\Packages\Bank;

class QueryCheckTest extends \PHPUnit\Framework\TestCase
{
    public function testQuery()
    {
        $bank = new Bank(__DIR__ . '/../data/banks.json');

        $nameBank = $bank->getBankByName('中国农业银行');
        $this->assertIsObject($nameBank);

        $codeBank = $bank->getBankByCode('ABC');
        $this->assertIsObject($codeBank);

        $list = $bank->forTest();
        $this->assertIsObject('检查Bin码失败:'.json_encode($list));

        $binBank = $bank->getBankByBin('625826');
        $this->assertIsObject($binBank,'检查Bin码失败:'.$bank->getBankList()->toJson());

        $cardBank = $bank->getBankByCardNumber('6258261234567890');
        $this->assertIsObject($cardBank);
    }

    public function testCheck()
    {
        $bank = new Bank(__DIR__ . '/../data/banks.json');

        $binBank = $bank->checkBin('625826');
        $this->assertIsBool($binBank);

        $cardBank = $bank->checkCardNumber('6258261234567890');
        $this->assertIsBool($cardBank);
    }

    public function testHelpers()
    {
        require_once(__DIR__.'/../src/helpers/safe_bank_number.php');
        $maskBank = safe_bank_number('6258261234567890');
        echo $maskBank;
        $this->assertIsString($maskBank);
    }
}