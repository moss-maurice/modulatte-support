<?php

namespace mmaurice\modulatte\Support\Helpers;

use Illuminate\Http\Request;

class ModuleHelper
{
    public static function makeUrl(array $data = [], $id = null, $full = false)
    {
        $request = Request::capture();
        $modx = EvolutionCMS();

        $data = array_merge([
            'a' => $request->input('a', 112),
            'id' => $request->input('id', $id),
        ], $data);

        if ($full) {
            return implode("?", [$modx->getManagerPath(), http_build_query($data)]);
        }

        return implode("?", [parse_url($modx->getManagerPath(), PHP_URL_PATH), http_build_query($data)]);
    }

    public static function redirect(array $data = [], $module = null, $full = false)
    {
        $url = static::makeUrl($data, $module, $full);

        return static::redirectUrl($url);
    }

    public static function redirectUrl($url)
    {
        header("Location: {$url}");

        exit;
    }

    public static function underScoreToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    public static function camelCaseToUnderScore($string)
    {
        return strtolower(preg_replace_callback('/([A-Z]+)/', function ($matches) {
            return '_' . strtolower($matches[1]);
        }, $string));
    }
}
