<?php

use Illuminate\Support\Facades\Cache;
use App\BusinessSetting;
use App\Translation;



//highlights the selected navigation on frontend
if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}

if (!function_exists('translate')) {

    function translate($key, $lang = null)
    {

        if ($lang == null) {
            $lang = session()->get('locale');
        }

        if ($lang == null) {
            $lang = App::getLocale();
        }


        //Check for session lang

        $string_key = str_replace(' ', '', $key);

        $value = Cache::rememberForever($string_key . '' . $lang, function () use ($lang, $key) {
            return App\Models\Translation::where('lang_key', $key)->where('lang', $lang)->first();
        });

        // $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
        if ($value != null && $value->lang_value != null) {
            return $value->lang_value;
            /*} elseif ($translation_def->lang_value != null) {
                return $translation_def->lang_value;*/
        } else {
            return $key;
        }
    }
}



function timezones()
{
    return Timezones::timezonesToArray();
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
    }
}

if (!function_exists('api_asset')) {
    function api_asset($id)
    {
        if (($asset = \App\Upload::find($id)) != null) {
            return $asset->file_name;
        }
        return "";
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if (($asset = \App\Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return null;
    }
}

if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            return app('url')->asset('public/' . $path, $secure);
        }
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('' . $path, $secure);
    }
}




if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
        $settings = Cache::remember('business_settings', 86400, function () {
            return BusinessSetting::all();
        });

        if ($lang == false) {
            $setting = $settings->where('type', $key)->first();
        } else {
            $setting = $settings->where('type', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
        }
        return $setting == null ? $default : $setting->value;
    }
}



?>
