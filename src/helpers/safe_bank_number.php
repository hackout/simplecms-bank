<?php

use Illuminate\Support\Str;

/**
 * 银行卡掩码
 * 
 * @param string $card_number
 * @param string $maskChar
 * @param int $start
 * @param int $length
 * @return string
 */
function safe_bank_number(string $card_number, string $maskChar = '*', int $start = 6, int $length = 4): string
{
    return Str::mask($card_number, $maskChar, $start, strlen($card_number) - ($start + $length));
}