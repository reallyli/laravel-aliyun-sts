# Laravel Aliyun STS

:jack_o_lantern: Aliyun STS for Laravel.

## Installing

```shell
$ composer require reallyli/laravel-aliyun-sts -v
```

After updated composer, if you are using laravel version < 5.5, you need to register service provider: 

```php
// config/app.php

'providers' => [
    //...
    Reallyli\AliyunSts\ServiceProvider::class,
],
```

And publish the config file: 

```shell
$ php artisan vendor:publish --provider=Reallyli\\AliyunSts\\ServiceProvider
```

if you want to use facade mode, you can register a facade name what you want to use, for example `AliyunSts`:

```php
// config/app.php

'aliases' => [
    'AliyunSts' => Reallyli\AliyunSts\AliyunSts::class, // This is default in laravel 5.5
],
```

### configuration 

```php
// config/sts.php

return [
    /**
     * @link https://help.aliyun.com/document_detail/100624.html
     * AccessKeyId、AccessKeySecret：子账号AK信息
     */
    'accessKeyId'     => env('ALIYUN_STS_ACCESS_KEY_ID'),
    'accessKeySecret' => env('ALIYUN_STS_ACCESS_KEY_SECRET'),

    /**
     * @link https://help.aliyun.com/document_detail/66053.html
     * regionId和endpoint
     */
    'regionId'        => env('ALIYUN_STS_REGION_ID'),
    'endpoint'        => env('ALIYUN_STS_ENDPOINT'),

    /**
     * @link https://help.aliyun.com/document_detail/100624.html
     * 创建角色(需要扮演的角色ID)
     */
    'roleArn'         => env('ALIYUN_STS_ROLE_ARN'),

    /**
     * @link https://help.aliyun.com/document_detail/100624.html
     * 设置临时凭证的有效期，单位是s，最小为900，最大为3600
     */
    'expiration'      => env('ALIYUN_STS_EXIRATION'),  // 令牌过期时间

    /**
     * @link https://help.aliyun.com/document_detail/100624.html
     * RoleSessionName即临时身份的会话名称，用于区分不同的临时身份
     */
    'clientName'      => env('ALIYUN_STS_CLIENT_NAME'),

    /**
     * @link https://help.aliyun.com/document_detail/100624.html
     * 创建权限策略(在扮演角色的时候额外添加的权限限制)
     */
    'policy'          => [
        'Statement' => [
            [
                'Action'   => "*",
                'Effect'   => 'Allow',
                'Resource' => [
                    "acs:oss:*:*:default",
                ],
            ],
        ],
        "Version"   => "1",
    ],
];
```

## Usage

```php
AliyunSts::getCredentials();
```

## Links

- [STS SDK](https://help.aliyun.com/document_detail/121136.html?spm=a2c4g.11186623.2.19.51543b49AiMApk#reference-w5t-25v-xdb)
- [使用STS临时授权](https://help.aliyun.com/document_detail/32106.html?spm=a2c4g.11186623.2.27.5fef3b49T5nwTA#section-8rj-9sk-q7r)

## Contact

- zlisreallyli@outlook.com
- http://www.reallyli.com