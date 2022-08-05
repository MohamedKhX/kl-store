<?php


use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Http;

function getSiteName()
{
    return app(GeneralSettings::class)->site_name;
}

function getStoreTitle()
{
    if(ar()) {
        return app(GeneralSettings::class)->store_title_ar;
    }
    return app(GeneralSettings::class)->store_title;
}

function getStoreDescription()
{
    if(ar()) {
        return app(GeneralSettings::class)->store_description_ar;
    }
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

function getPhoneNumber()
{
    return app(GeneralSettings::class)->store_phone_number;
}

function getStoreEmail()
{
    return app(GeneralSettings::class)->store_email;
}

function getFilter()
{
    return app(GeneralSettings::class)->thumbnail_filter;
}

function getStoreThumbnail(): string
{
    return 'storage/' . app(GeneralSettings::class)->store_thumbnail;
}

function getStoreIcon(): string
{
    if(app(GeneralSettings::class)->store_icon == "") {
        return asset('img/logo.png') ;
    }
    return 'storage/' . app(GeneralSettings::class)->store_icon;
}

function transformCurrency($price, $earnings, $from = 'TRY', $to = 'LYD')
{
    $response = Http::withOptions(['verify' => false])->withHeaders([
        'X-Api-Key' => 'DekERxC2A9lMEikr7KaZVw==K4AxfPvmpWuYppVZ',
    ])->get("https://api.api-ninjas.com/v1/convertcurrency?want={$to}&have={$from}&amount={$price}")
        ->json();

    if(isset($response['new_amount'])) {
        return $response['new_amount'] * ($earnings / 100) + $response['new_amount'];
    }

    return 404;
}

function getStoreMetaPhoto()
{
    return url('storage/', app(GeneralSettings::class)->store_meta_photo);
}

function arRight(): ?string
{
    return  \Illuminate\Support\Facades\Lang::getLocale() === 'ar' ? 'text-end' : null;
}

function ar(): bool
{
    return  \Illuminate\Support\Facades\Lang::getLocale() === 'ar';
}
function cmp($a, $b)
{
    $sizes = getLettersSizes();

    $aSize = $sizes[$a->size];
    try {
        $bSize = $sizes[$b->size];

    } catch (Exception $exception) {
        dd($sizes, $b, $a);
    }

    if ($aSize == $bSize) {
        return 0;
    }

    return ($aSize > $bSize) ? 1 : -1;
}

function checkSizeTypeNumeric($size): bool
{
    $sizes = getLettersSizes();

    return ! array_key_exists($size, $sizes);
}


function getLettersSizes(): array
{
    return [
        'XXS' => 0,
        'XS' => 1,
        'S' => 2,
        'M' => 3,
        'L' => 4,
        'XL' => 5,
        '2XL' => 6,
        'XXL' => 6,
        '3XL' => 7,
        'XXXL' => 7,
        '4XL' => 8,
        'XXXXL' => 8,
        '5XL' => 9,
        '6XL' => 10
    ];
}

function getProductsColors($products): \Illuminate\Support\Collection
{
    $allProducts = [];

    foreach ($products as $product) {
        foreach ($product->colorsWithSizes() as $color) {
            $allProducts[] = $color;
        }
    }
    return collect($allProducts)->sortByDesc('priority');
}


function toBase62 ($dec) {

    // 0 is always 0
    if ($dec == 0)
        return "0";

    // this array maps decimal keys to our base-62 radix digits
    $values = array(
        "0", "1", "2", "3", "4",
        "5", "6", "7", "8", "9",
        "A", "B", "C", "D", "E",
        "F", "G", "H", "I", "J",
        "K", "L", "M", "N", "O",
        "P", "Q", "R", "S", "T",
        "U", "V", "W", "X", "Y",
        "Z", "a", "b", "c", "d",
        "e", "f", "g", "h", "i",
        "j", "k", "l", "m", "n",
        "o", "p", "q", "r", "s",
        "t", "u", "v", "w", "x",
        "y", "z"
    );

    // convert negative numbers to positive.
    $neg = $dec < 0;
    if ($neg)
        $dec = 0 - $dec;

    // do the conversion:
    $chars = array(); // this will store our base-62 chars

    while ($dec > 0) {

        $val = $dec % 62;

        $chars[] = $values[$val];

        $dec -= $val;
        $dec /= 62;

    }

    // add zero-padding:
    while (count($chars) < 6)
        $chars[] = '0';

    // convert to string
    $rv = implode( '' , array_reverse($chars) );

    // if input was negative:
    return $neg ? "-$rv" : $rv;

}
