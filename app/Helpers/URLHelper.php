<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class URLHelper{
    public static function has($subUrl){
        $currentURL = explode('/', URL::current());
        return $currentURL[count($currentURL) - 1] == $subUrl;
    }
}