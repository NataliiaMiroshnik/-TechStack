<?php

interface Downloader
{
    public function download(string $url): string;
}

class SimpleDownloader implements Downloader
{
    public function download(string $url): string
    {
        // Логіка завантаження файлу з вказаного url
    }
}

class CachingDownloader implements Downloader
{
    private $simpleDownloader;
    private $cache = [];

    public function __construct(SimpleDownloader $simpleDownloader)
    {
        $this->simpleDownloader = $simpleDownloader;
    }

    public function download(string $url): string
    {
        if (!isset($this->cache[$url])) {
            // Якщо даних немає в кеші, використовуємо SimpleDownloader
            $data = $this->simpleDownloader->download($url);
            $this->cache[$url] = $data;
        }

        // Повертаємо дані з кешу
        return $this->cache[$url];
    }
}

$simpleDownloader = new SimpleDownloader();
$cachingDownloader = new CachingDownloader($simpleDownloader);
$content = $cachingDownloader->download('http://example.com/file.txt');

?>