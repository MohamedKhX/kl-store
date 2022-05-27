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


    public static function group(): string
    {
        return 'general';
    }
}
