<?php


use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Http;

function getSiteName()
{
    return app(GeneralSettings::class)->site_name;
}


function getStoreTitle()
{
    return app(GeneralSettings::class)->store_title;
}

function getStoreDescription()
{
    return app(GeneralSettings::class)->store_description;
}


function getAppActiveState()
{
    return app(GeneralSettings::class)->app_active;
}

function getAbilityToCreateAccounts()
{
    return app(GeneralSettings::class)->ability_to_create_accounts;
}


function getAbilityToLogin()
{
    return app(GeneralSettings::class)->ability_to_login;
}


function getAbilityToOrder()
{
    return app(GeneralSettings::class)->ability_to_order;
}


function getPhoneNumber() {
    return app(GeneralSettings::class)->store_phone_number;
}

function getStoreEmail() {
    return app(GeneralSettings::class)->store_email;
}


function getStoreThumbnail() {
    return 'storage/' . app(GeneralSettings::class)->store_thumbnail;
}

function transformCurrency($price, $from = 'TRY', $to = 'LYD')
{
    $response = Http::withOptions(['verify' => false])->withHeaders([
        'X-Api-Key' => 'DekERxC2A9lMEikr7KaZVw==K4AxfPvmpWuYppVZ',
    ])->get("https://api.api-ninjas.com/v1/convertcurrency?want={$to}&have={$from}&amount={$price}")
        ->json();

    return $response['new_amount'];
}
