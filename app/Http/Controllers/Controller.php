<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // update pdf
    public function fileUpload($img,$path){
        if (!empty($img)) {
            $file_name = time() . "_" . $img->getClientOriginalName();
            $img->move(public_path($path), $file_name);
            return $file_name;
        }
        return false;
    }
}
