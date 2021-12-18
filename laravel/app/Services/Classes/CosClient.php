<?php

namespace Services\Classes;

use Qcloud\Cos\Client;

Class CosClient
{

    protected $secretId = "";

    protected $secretKey = "";
    protected $token = ""; // 使用临时密钥需要传入Token，默认为空,可不填
    protected $region = "";
    protected $schema = "https";
    protected $bucket = "";

    protected $service;

    public $url = "";
    public $dir = "";

    public function __construct()
    {
        $this->secretId = config("game.cos.secretId",'');
        $this->secretKey = config("game.cos.secretKey",'');
        $this->token = ""; // 使用临时密钥需要传入Token，默认为空,可不填
        $this->region = config("game.cos.region",'');
        $this->schema = "https";
        $this->bucket = config("game.cos.bucket",'');
        $this->url = config("game.cos.url",''); //区服文件在cos的url前缀
        $this->dir = config("game.cos.dir",''); //区服文件在cos上的文件夹

        $this->service = new Client([
            'region' => $this->region,
            'schema' => 'https', //协议头部，默认为http
            'credentials' => [
                'secretId'  => $this->secretId,
                'secretKey' => $this->secretKey,
                'token'     => $this->token
            ]
        ]);
    }

    /**
     * 上传Json
     *
     * @param string $content
     * @param string $name
     * @return string $addr
     */
    public function upLoadJson($content, $name)
    {
        $ret = $this->service->upload($this->bucket, $this->dir.$name, $content, ['ContentEncoding' => 'utf-8']);
        return $ret['Location'];
    }

    /**
     * 删除对象
     *
     * @param string $name 对象名
     * @return object
     */
    public function deleteObj($name){
        $ret = $this->service->DeleteObject([
            'Bucket' => $this->bucket, //存储桶名称，由BucketName-Appid 组成，可以在COS控制台查看 https://console.cloud.tencent.com/cos5/bucket
            'Key' => $name,
        ]);
        return $ret;
    }
}
