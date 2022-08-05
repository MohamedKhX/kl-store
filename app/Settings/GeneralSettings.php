<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $app_active;

    public bool $ability_to_create_accounts;
    public bool $ability_to_login;
    public bool $ability_to_order;

    public string $site_name;

    public string $store_title;
    public string $store_description;

    public string $store_title_ar;
    public string $store_description_ar;

    public string $store_thumbnail;
    public float  $thumbnail_filter;
    public string $store_phone_number;
    public string $store_email;
    public string $store_icon;
    public string $store_meta_photo;

    public string $privacy_description;

    public static function group(): string
    {
        return 'general';
    }
}
