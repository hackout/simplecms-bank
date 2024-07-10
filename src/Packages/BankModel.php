<?php
namespace SimpleCMS\Bank\Packages;

use Illuminate\Support\Collection;

/**
 * 银行卡模块
 *
 * @author Dennis Lui <hackout@vip.qq.com>
 */
class BankModel implements \JsonSerializable
{
    /**
     * 银行名称
     *
     * @var string|null
     */
    public string $name;

    /**
     * 银行代码
     *
     * @var string|null
     */
    public string $code;

    /**
     * Bin 列表
     *
     * @var Collection<BinModel>|null
     */
    public Collection $bins;

    public function __construct(string $name, string $code, array $bins)
    {
        $this->name = $name;
        $this->code = $code;
        $this->bins = collect();
        $this->pushBins($bins);
    }

    /**
     * 将 Bin 数据推入到 BankModel 中
     *
     * @param array $data
     * @return void
     */
    protected function pushBins(array $data): void
    {
        foreach ($data as $type => $_bins) {
            foreach ($_bins as $length => $bin) {
                $this->bins->push(new BinModel((string) $bin, (string) $type, (int) $length));
            }
        }
    }

    /**
     * 检查卡号有效性
     *
     * @param string $card_number
     * @return bool
     */
    public function isValid(string $card_number): bool
    {
        return $this->bins->contains(fn(BinModel $bin) => $bin->isValid($card_number));
    }

    // 下面是获取不同类型的 Bin 列表的方法，每个方法返回对应类型的 Bin 列表

    /**
     * 返回储蓄卡列表
     *
     * @return Collection|null
     */
    public function getDC(): ?Collection
    {
        return $this->bins ? $this->bins->filter(fn($n) => $n->type == 'DC')->values() : null;
    }

    /**
     * 返回预付费卡列表
     *
     * @return Collection|null
     */
    public function getPC(): ?Collection
    {
        return $this->bins ? $this->bins->filter(fn($n) => $n->type == 'PC')->values() : null;
    }

    /**
     * 返回信用卡列表
     *
     * @return Collection|null
     */
    public function getCC(): ?Collection
    {
        return $this->bins ? $this->bins->filter(fn($n) => $n->type == 'CC')->values() : null;
    }

    /**
     * 检查Bin是否存在
     * @param string $bin
     * @return bool
     */
    public function hasBin(string $bin): bool
    {
        return $this->bins->contains(fn($binModel) => $binModel->bin === $bin);
    }

    /**
     * 检查银行是否包含特定的卡号
     *
     * @param string $cardNumber 完整卡号
     * @return bool
     */
    public function hasCardNumber(string $cardNumber): bool
    {
        return $this->bins->contains(fn($binModel) => strpos($cardNumber, $binModel->bin) === 0);
    }

    /**
     * 返回准贷记卡列表
     *
     * @return Collection|null
     */
    public function getSCC(): ?Collection
    {
        return $this->bins ? $this->bins->filter(fn($n) => $n->type == 'SCC')->values() : null;
    }

    /**
     * 将 BankModel 对象序列化为数组
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'name' => $this->name ?? null,
            'code' => $this->code ?? null,
            'bins' => $this->bins ? $this->bins->toArray() : null
        ];
        return $data;
    }

    /**
     * 将 BankModel 对象序列化为 JSON
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * 将 BankModel 对象转换为 JSON 字符串
     *
     * @return string
     */
    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}