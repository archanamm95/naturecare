<?php
use App\Currency;

/**
 * Returns default string 'active' if route is active.
 *
 * @param $route
 * @param string $str
 * @return string
 */
function set_active($route, $str = 'active nav-item-open')
{
    return (Request::is($route) && !Request::is($route.'/*')) ? $str : '';
}

function set_active_display($route, $str = "display:block")
{
    return (Request::is($route) && !Request::is($route.'/*')) ? $str : '';
}

function currencyConvert($amount, $symbol_placement = 'left', $currency = 'USD')
{
    $currency = currency()->getUserCurrency();
    $symbol = Currency::where('code', $currency)->value('symbol');
    $converted = currency($amount);
    $markup = $symbol.' '.$converted;
    if ($symbol_placement === 'right') {
        $markup = $converted.' '.$symbol;
    }
    return $markup;
}


function convertToReadableSize($size)
{
    $base = log($size) / log(1024);
    $suffix = array("", "KB", "MB", "GB", "TB");
    $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}

if (!function_exists('option')) {
    function option($key, $default = null)
    {
        return App\Models\ControlPanel\Options::option($key, $default);
    }
}

if (!function_exists('createOption')) {
    function createOption($key, $display_name = null, $value = null, $details = null, $type = null, $order = null, $group = null)
    {
        $key = $key;
        $display_name = $display_name;
        $value = $value;
        $details = $details;
        $type = $type;
        $order = $order;
        $group = $group;

        return App\Models\ControlPanel\Options::createOption($key, $default);
    }
}


if (!function_exists('updateOption')) {
    function updateOption($key, $default = null)
    {
        return App\Models\ControlPanel\Options::updateOption($key, $display_name = null, $value = null, $details = null, $type = null, $order = null, $group = null);
    }
}


if (!function_exists('updateOptionBykey')) {
    function updateOptionBykey($key, $value = null)
    {
        return App\Models\ControlPanel\Options::funcUpdateOptionBykey($key, $value = null);
    }
}
