<?php

namespace App\Helpers;

class ImageHelper
{
    // Default placeholder
    public static function placeholder(): string
    {
        return 'https://lh3.googleusercontent.com/d/15Ubr-kYNPIjph3G5Rnyspc02n6Zw_0LD';
    }

    // Ambil URL gambar atau fallback ke placeholder
    public static function productImage(?string $url): string
    {
        return $url ?: self::placeholder();
    }
}
