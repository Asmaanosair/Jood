<?php
if(!function_exists('AdminAssets')){
    function AdminAssets($url=null){
        return url('adminassets/assets/'.$url);
    }
}
if(!function_exists('AdminUrl')){
    function AdminUrl($url=null){
        return url('admin/'.$url);
    }
}
if(!function_exists('AdminGuard')){
    function AdminGuard(){
        return auth()->guard('admin');
    }
}


