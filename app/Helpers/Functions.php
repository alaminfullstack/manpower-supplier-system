<?php

use App\Models\Currency;
use App\Models\Invoice;
use App\Models\SystemSetting;


// ======== get system setting ============
if(!function_exists('get_system_setting')){
    function get_system_setting()
    {
        return SystemSetting::first();
    }
}


// ========= get system title ===============
if(!function_exists('get_system_title')){
    function get_system_title(){
        return get_system_setting()->app_title;
    }
}


// ========= get system default image ===============
if(!function_exists('get_system_default_image')){
    function get_system_default_image(){
        return get_system_setting()->default_image;
    }
}


// // ========= get system date format ===============
if(!function_exists('get_system_date_format')){
    function get_system_date_format($date){
        $setting = get_system_setting()->date_format;
        $format = $setting ?? 'd-m-Y';
        return date($format, strtotime($date));
    }
}


// // ========= get system date Time format ===============
if(!function_exists('get_system_date_time_format')){
    function get_system_date_time_format($date){
        $setting = get_system_setting()->date_time_format;
        $format = $setting ?? 'd-m-Y h:i:s'; 
        return date($format, strtotime($date));
    }
}

// // ======== get system currency format ================

if (! function_exists('get_system_currency_format')) {
    function get_system_currency_format($amount)
    {
        $currency = Currency::find(get_system_setting()->default_currency);
        $position = get_system_setting()->currency_position ?? 'left';
        $value = $currency->conversion_rate ?? 1;
        $symbol = get_system_setting()->currency_symbol ?? '$';
        $format_amount = $value*$amount;

        if($position == 'left'){
            return $symbol.$format_amount;
        }

        if($position == 'left_with_space'){
            return $symbol.' '.$format_amount;
        }

        if($position == 'right'){
            return $format_amount.$symbol;
        }

        if($position == 'right_with_space'){
            return $format_amount.' '.$symbol;
        }
    }
}

// // ========= get system timezone ============
if(!function_exists('get_system_default_time_zone')){
    function get_system_default_time_zone(){
        return get_system_setting()->default_time_zone;
    }
}


// // ========= get system decimal number limit ============
if(!function_exists('get_system_decimal_number_limit')){
    function get_system_decimal_number_limit(){
        return get_system_setting()->decimal_number_limit;
    }
}


// ========== get text english to arabic convert ===========
if(!function_exists('get_english_to_arabic')){
    function get_english_to_arabic($text)
    {
       
        $english_char = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
        $arabic_char = array('أ','ب','ك','د','ي','ف','غ','ه','ي','ج','ك','ل','م','ن','و','ب','ق','ر','س','ت','و','ف','و','كس','ي','ز','٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

        $arabic_name = str_replace($english_char, $arabic_char, strtolower($text));
        return $arabic_name;
       
    }
}

// ================== get 12 month ===============
if(!function_exists('get_all_months')){
    function get_all_months(){
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];
        return $months;
    }
}

// ================ generate random invoice number ===============
if(!function_exists('get_random_invoice_no')){
  function get_random_invoice_no()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (Invoice::where("invoice_number", "=", $code)->first());
  
        return $code;
    }
}


