<?php


use App\Settings\GeneralSettings;

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
