<?php

namespace modules;

require(__DIR__ . '/../aws/aws-autoloader.php');

use \lib\core\Module;
use \lib\core\Path;
use \lib\db\Connection;
use \lib\db\SqlBuilder;
use \Aws\S3\S3Client;

class s3 extends Module
{
    public function provider($options, $name) {
        $pos = stripos($options->endpoint, '.amazonaws');
        $region = 'us-east-1';

        if ($pos) {
            $region = substr($options->endpoint, 3, $pos - 3);
        }

        return new \Aws\S3\S3Client([
            'version' => 'latest',
            'region' => $region,
            'endpoint' => 'https://' . $options->endpoint,
            'credentials' => [
                'key' => $options->accessKeyId,
                'secret' => $options->secretAccessKey
            ]
        ]);
    }

    public function createBucket($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_default($options, 'acl', NULL);

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        return $s3->createBucket([
            'Bucket' => $options->bucket,
            'ACL' => $options->acl
        ]);
    }

    public function listBuckets($options) {
        option_require($options, 'provider');

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $data = $s3->listBuckets();

        foreach ($data['Buckets'] as &$bucket) {
            $bucket['CreationDate'] = (string)$bucket['CreationDate'];
        }

        return $data;
    }

    public function deleteBucket($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        return $s3->deleteBucket([
            'Bucket' => $options->bucket
        ]);
    }

    public function listFiles($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_default($options, 'maxKeys', 1000);
        option_default($options, 'prefix', NULL);
        option_default($options, 'continuationToken', NULL);
        option_default($options, 'startAfter', NULL);

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $data = $s3->listObjectsV2([
            'Bucket' => $options->bucket,
            'MaxKeys' => $options->maxKeys,
            'Prefix' => $options->prefix,
            'ContinuationToken' => $options->continuationToken,
            'StartAfter' => $options->startAfter
        ]);

        foreach ($data['Contents'] as &$content) {
            $content['LastModified'] = (string)$content['LastModified'];
        }

        return $data;
    }

    public function putFile($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_require($options, 'key');
        option_require($options, 'path');
        option_default($options, 'acl', NULL);

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $path = Path::toSystemPath($options->path);

        return $s3->putObject([
            'Bucket' => $options->bucket,
            'Key' => $options->key,
            'Body' => file_get_contents($path),
            'ACL' => $options->acl
        ]);
    }

    public function getFile($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_require($options, 'key');
        option_require($options, 'path');

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $path = Path::toSystemPath($options->path);

        $data = $s3->getObject([
            'Bucket' => $options->bucket,
            'Key' => $options->key,
            'Body' => file_get_contents($path)
        ]);

        return file_put_contents($path, $data['Body']);
    }

    public function deleteFile($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_require($options, 'key');

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        return $s3->listObjects([
            'Bucket' => $options->bucket,
            'Key' => $options->key
        ]);
    }

    public function signDownloadUrl($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_require($options, 'key');
        option_default($options, 'expires', 300);

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $cmd = $s3->getCommand('GetObject', [
            'Bucket' => $options->bucket,
            'Key' => $options->key
        ]);

        $request = $s3->createPresignedRequest($cmd, '+' . $options->expires . ' seconds');

        return (string)$request->getUri();
    }

    public function signUploadUrl($options) {
        option_require($options, 'provider');
        option_require($options, 'bucket');
        option_require($options, 'key');
        option_default($options, 'expires', 300);
        option_default($options, 'acl', NULL);

        $options = $this->app->parseObject($options);

        $s3 = $this->app->scope->get($options->provider);

        $cmd = $s3->getCommand('PutObject', [
            'Bucket' => $options->bucket,
            'Key' => $options->key,
            'ACL' => $options->acl
        ]);

        $request = $s3->createPresignedRequest($cmd, '+' . $options->expires . ' seconds');

        return (string)$request->getUri();
    }
}