<?php
namespace SimpleCMS\Bank\Tests;

use SimpleCMS\Bank\Packages\Bank;

class BankListTest extends \PHPUnit\Framework\TestCase
{
 
    public function testBankList()
    {
        $bank = new Bank(__DIR__ . '/../data/banks.json');

        $bankList = $bank->getBankList();
        $this->assertIsObject($bankList);

        $options = $bank->getOptions();
        $this->assertIsObject($options);

        $optionsDC = $bank->getOptions('DC');
        $this->assertIsObject($optionsDC);

        $optionsCC = $bank->getOptions('CC');
        $this->assertIsObject($optionsCC);

        $optionsSCC = $bank->getOptions('SCC');
        $this->assertIsObject($optionsSCC);

        $optionsPC = $bank->getOptions('PC');
        $this->assertIsObject($optionsPC);
    }
}