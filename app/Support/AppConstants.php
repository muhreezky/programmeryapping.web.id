<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;

class AppConstants
{
    /**
     * Get a configuration value from app-constants.php.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Config::get("app-constants.{$key}", $default);
    }

    /**
     * Get pagination settings.
     */
    public static function pagination(string $key = 'default_per_page'): int
    {
        return self::get("pagination.{$key}", 15);
    }

    /**
     * Get file upload settings.
     */
    public static function fileUpload(string $key): mixed
    {
        return self::get("file_upload.{$key}");
    }

    /**
     * Get UI settings.
     */
    public static function ui(string $key): mixed
    {
        return self::get("ui.{$key}");
    }

    /**
     * Get skills list.
     */
    public static function skills(): array
    {
        return self::get('skills', []);
    }

    /**
     * Get socials list.
     */
    public static function socials(): array
    {
        return self::get('socials', []);
    }

    /**
     * Get Indonesian months.
     */
    public static function indonesianMonths(): array
    {
        return self::get('indonesian_months', []);
    }

    /**
     * Get date formats.
     */
    public static function dateFormat(string $key): string
    {
        return self::get("date_formats.{$key}", 'j F Y');
    }

    /**
     * Get excerpt limits.
     */
    public static function excerptLimit(string $key): int
    {
        return self::get("excerpt_limits.{$key}", 110);
    }

    /**
     * Get routes.
     */
    public static function route(string $key): string
    {
        return self::get("routes.{$key}", $key);
    }

    /**
     * Get validation rules.
     */
    public static function validation(string $key): mixed
    {
        return self::get("validation.{$key}");
    }

    /**
     * Get cache settings.
     */
    public static function cache(string $key): mixed
    {
        return self::get("cache.{$key}");
    }
}
