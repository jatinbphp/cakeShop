<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function image($photo, $path){
        $root = storage_path('app/public/uploads/'.$path);
        $name = Str::random(20).".".$photo->getClientOriginalExtension();
        $mimetype = $photo->getMimeType();
        $explode = explode("/",$mimetype);
        $type = $explode[0];

        if (!file_exists($root)) {
            mkdir($root, 0777, true);
        }
        $photo->move($root,$name);
        return $path = 'uploads/'.$path."/".$name;
    }
}
