<?php

class StorageManager
{
    private static $instance;
    private $storage;

    private function __construct() {}

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function uploadFile($file)
    {
        return $this->storage->upload($file);
    }

    public function downloadFile($file)
    {
        return $this->storage->download($file);
    }
}

interface StorageInterface
{
    public function upload($file);
    public function download($file);
}

class LocalStorage implements StorageInterface
{
    public function upload($file)
    {
        // Логіка завантаження файлу на локальний диск
    }

    public function download($file)
    {
        // Логіка завантаження файлу з локального диску
    }
}

class AmazonS3Storage implements StorageInterface
{
    public function upload($file)
    {
        // Логіка завантаження файлу на Amazon S3
    }

    public function download($file)
    {
        // Логіка завантаження файлу з Amazon S3
    }
}

$storageManager = StorageManager::getInstance();
$localStorage = new LocalStorage();
$storageManager->setStorage($localStorage);
$storageManager->uploadFile('file.txt');
$storageManager->downloadFile('file.txt');

?>
