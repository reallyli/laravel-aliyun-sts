<?php

namespace Reallyli\AliyunSts;

use AlibabaCloud\Client\AlibabaCloud;
use Illuminate\Support\Arr;

/**
 * Class Manager.
 *
 * @author reallyli <zlisreallyli@outlook.com>
 */
class Manager
{
    /**
     * @var array
     */
    protected $configs;

    /**
     * Construct
     *
     * @param array $configs
     * @author reallyli <zlisreallyli@outlook.com>
     */
    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * Get Config
     *
     * @param string $attr
     * @param string $default
     * @return mixed
     * @author reallyli <zlisreallyli@outlook.com>
     */
    public function getConfig(string $attr, string $default = '')
    {
        return Arr::get($this->configs, $attr, $default);
    }

    /**
     * Get Credentials
     *
     * @return array
     * @author reallyli <zlisreallyli@outlook.com>
     */
    public function getCredentials()
    {
        AlibabaCloud::accessKeyClient($this->getConfig('accessKeyId'), $this->getConfig('accessKeySecret'))
            ->regionId($this->getConfig('regionId'))
            ->asDefaultClient();

        return AlibabaCloud::rpc()
            ->product($this->getConfig('product', 'Sts'))
            ->scheme($this->getConfig('scheme', 'https')) // https | http
            ->version($this->getConfig('version', '2015-04-01'))
            ->action($this->getConfig('action', 'AssumeRole'))
            ->method($this->getConfig('method', 'POST'))
            ->host($this->getConfig('endpoint'))
            ->options([
                'query' => [
                    'RegionId' => $this->getConfig('regionId'),
                    'RoleArn' => $this->getConfig('roleArn'),
                    'RoleSessionName' => $this->getConfig('clientName'),
                    "Policy" => json_encode($this->getConfig('policy'))
                ],
            ])
            ->request()
            ->toArray();
    }
}
