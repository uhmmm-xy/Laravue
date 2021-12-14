<?php

namespace Services\Classes;

use Qcloud\Cos\Client;

class CosClient
{

    protected const SECRETID = config("game.cos.secretId");

    protected const SECRETKEY = config("game.cos.secretKey");
    protected const TOKEN = ""; // 使用临时密钥需要传入Token，默认为空,可不填
    protected const REGION = config("game.cos.region");
    protected const SCHEMA = "https";
    protected const BUCKET = config("game.cos.bucket");

    public const URL = config("game.cos.url"); //区服文件在cos的url前缀
    public const DIR = config("game.cos.dir"); //区服文件在cos上的文件夹

    public static function updateJson($content, $name)
    {
        $service = new Client([
            'region' => self::REGION,
            'schema' => 'https', //协议头部，默认为http
            'credentials' => [
                'secretId'  => self::SECRETID,
                'secretKey' => self::SECRETKEY,
                'token'     => self::TOKEN
            ]
        ]);

        $ret = $service->upload(self::BUCKET, self::DIR.$name, $content, ['ContentEncoding' => 'utf-8']);
        return $ret;
    }
}
