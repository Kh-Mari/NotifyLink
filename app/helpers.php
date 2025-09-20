<?php
use App\Services\TranslationService;

if (!function_exists('t')) {
    function t($key, $locale = null) {
        return TranslationService::get($key, $locale);
    }
}

if (!function_exists('isRTL')) {
    function isRTL($locale = null) {
        return TranslationService::isRTL($locale);
    }
}

if (!function_exists('getCurrentLocale')) {
    function getCurrentLocale() {
        return TranslationService::getCurrentLocale();
    }
}