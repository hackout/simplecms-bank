<?php

namespace SimpleCMS\Bank;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use SimpleCMS\Bank\Validation\Rule\BankRule;
use SimpleCMS\Bank\Validation\Rule\BankBinRule;
use SimpleCMS\Bank\Validation\Rule\BankCardRule;
use SimpleCMS\Bank\Validation\Rule\BankCodeRule;

class BankServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadedHelpers();
        $this->loadFacades();
        $this->loadedValidator();
    }

    /**
     * 加载验证
     *
     * @author Dennis Lui <hackout@vip.qq.com>
     * @return void
     */
    protected function loadedValidator(): void
    {
        Validator::extend(
            'bank',
            BankRule::class
        );
        Validator::extend(
            'bank_card',
            BankCardRule::class
        );
        Validator::extend(
            'bank_code',
            BankCodeRule::class
        );
        Validator::extend(
            'bank_bin',
            BankBinRule::class
        );
    }


    /**
     * 绑定Facades
     *
     * @author Dennis Lui <hackout@vip.qq.com>
     * @return void
     */
    protected function loadFacades(): void
    {
        $this->app->bind('bank', fn() => new \SimpleCMS\Bank\Packages\Bank(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '/data/banks.json'));
    }
    
    /**
     * 加载辅助函数
     *
     * @author Dennis Lui <hackout@vip.qq.com>
     * @return void
     */
    protected function loadedHelpers(): void
    {

        foreach (scandir(__DIR__ . DIRECTORY_SEPARATOR . 'helpers') as $helperFile) {
            $path = sprintf(
                '%s%s%s%s%s',
                __DIR__,
                DIRECTORY_SEPARATOR,
                'helpers',
                DIRECTORY_SEPARATOR,
                $helperFile
            );

            if (!is_file($path)) {
                continue;
            }

            $function = Str::before($helperFile, '.php');

            if (function_exists($function)) {
                continue;
            }

            require_once $path;
        }
    }
}
