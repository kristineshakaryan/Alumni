<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Crypt;

class DatabaseController extends Controller
{
    //show database
    public function ShowDatabase($id = null)
    {
        $columns = [];
        $feilds = [];
        $tables = DB::select('SHOW TABLES');
        if (!is_null($id)){
            if ($table = $tables[$id]->Tables_in_datalumni){
                $columns = DB::select("SHOW COLUMNS FROM ". $table);
                $feilds = DB::select("SELECT * from ". $table);
                return view('super_admin.database.showdatabase',compact('tables','columns','feilds'));
            }
        }
        return view('super_admin.database.showdatabase',compact('tables','columns','feilds'));
    }

}
