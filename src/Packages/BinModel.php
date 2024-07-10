<?php
namespace SimpleCMS\Bank\Packages;

/**
 * Bin模型
 */
class BinModel implements \JsonSerializable
{
    /**
     * Bin码
     * @var string
     */
    private string $bin;

    /**
     * 卡号长度
     * @var int
     */
    private int $length = 0;

    /**
     * 卡类型
     * @var string<'DC','PC','CC','SCC'>
     */
    private string $type = 'DC';

    public function __construct(string $bin, string $type, int $length)
    {
        $this->bin = $bin;
        $this->type = $type;
        $this->length = $length;
    }

    public function toArray(): array
    {
        return [
            'bin' => $this->bin,
            'length' => $this->length,
            'type' => $this->type
        ];
    }

    /**
     * 检查有效性
     * @param string $card_number
     * @return bool
     */
    public function isValid(string $card_number): bool
    {
        if (strpos($card_number, $this->bin) !== 0) {
            return false;
        }
        if (strlen($card_number) !== $this->length) {
            return false;
        }
        return true;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function __toString(): string
    {
        return json_encode($this);
    }
}