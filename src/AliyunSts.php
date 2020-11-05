<?php

namespace Reallyli\AliyunSts;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Class AliyunSts
 *
 * @author reallyli <zlisreallyli@outlook.com>
 */
class AliyunSts extends LaravelFacade
{
    public static function getFacadeAccessor()
    {
        return Manager::class;
    }
}