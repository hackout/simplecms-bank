<?php
namespace SimpleCMS\Bank\Packages;

use Illuminate\Support\Collection;

/**
 * 银行卡模块
 */
class Bank
{
    protected Collection $banks;

    /**
     * Bank构造函数
     *
     * @param string $region_path 区域路径
     */
    public function __construct(protected string $bank_path)
    {
        $this->banks = new Collection([]);
        $this->loadBanks();
    }

    /**
     * 从指定区域路径加载银行数据
     */
    protected function loadBanks(): void
    {
        $content = file_get_contents(env('REGION_PATH', $this->bank_path));

        try {
            $data = json_decode($content, true);

            foreach ($data as $bank) {
                $this->banks->push($this->convertBank($bank));
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * 将表示银行的数组转换为BankModel对象
     *
     * @param array $bankData 银行数据数组
     * @return BankModel
     */
    protected function convertBank(array $bankData): BankModel
    {
        $obj = new BankModel(
            $bankData['name'] ?? null,
            $bankData['code'] ?? null,
            $bankData['bins'] ?? []
        );

        return $obj;
    }

    /**
     * 获取银行列表
     *
     * @return Collection
     */
    public function getBankList(): Collection
    {
        return $this->banks;
    }

    /**
     * 通过银行代码查询银行
     *
     * @param string $code 银行代码
     * @return BankModel|null
     */
    public function getBankByCode(string $code): ?BankModel
    {
        return $this->banks->first(fn($bank) => $bank->code === $code);
    }

    /**
     * 通过银行名称查询银行
     *
     * @param string $name 银行名称
     * @return BankModel|null
     */
    public function getBankByName(string $name): ?BankModel
    {
        return $this->banks->first(fn($bank) => $bank->name === $name);
    }

    /**
     * 通过BIN查询银行
     *
     * @param string $bin BIN码
     * @return BankModel|null
     */
    public function getBankByBin(string $bin): ?BankModel
    {
        return $this->banks->first(fn(BankModel $bank) => $bank->hasBin($bin));
    }

    /**
     * 通过卡号查询银行
     *
     * @param string $cardNumber 完整卡号
     * @return BankModel|null
     */
    public function getBankByCardNumber(string $cardNumber): ?BankModel
    {
        return $this->banks->first(fn($bank) => $bank->hasCardNumber($cardNumber));
    }

    /**
     * 检查指定BIN是否有效
     *
     * @param string $bin BIN码
     * @return bool
     */
    public function checkBin(string $bin): bool
    {
        return $this->banks->contains(fn($bank) => $bank->isValid($bin));
    }

    /**
     * 返回<value:,name:>格式的选项列表
     *
     * @param string $type 获取类型
     * @return Collection
     */
    public function getOptions(string $type = 'all'): Collection
    {
        if ($type == 'all')
            return $this->banks->map(fn(BankModel $bankModel) => ['value' => $bankModel->code, 'name' => $bankModel->name]);
        $type = strtoupper($type);
        return $this->banks->filter(function (BankModel $bankModel) use ($type) {
            return match ($type) {
                'PC' => $bankModel->getPC()->count() > 0,
                'CC' => $bankModel->getCC()->count() > 0,
                'DC' => $bankModel->getDC()->count() > 0,
                'SCC' => $bankModel->getSCC()->count() > 0,
                default => false
            };
        })->values()->map(fn(BankModel $bankModel) => ['value' => $bankModel->code, 'name' => $bankModel->name]);
    }
}