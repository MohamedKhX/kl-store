<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $app_active                 = true;

    public bool $ability_to_create_accounts = true;
    public bool $ability_to_login           = true;
    public bool $ability_to_order           = true;

    public string $site_name         = 'Arkan';

    public string $store_title       = 'Arkan Store';
    public string $store_description = 'High Quality at cheap price';

    public string $store_title_ar       = 'Arkan Store';
    public string $store_description_ar = 'High Quality at cheap price';

    public string $store_thumbnail;
    public float  $thumbnail_filter;
    public string $store_phone_number;
    public string $store_email;
    public string $store_icon;


    public static function group(): string
    {
        return 'general';
    }
}
