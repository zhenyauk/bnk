<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use Illuminate\Http\Request;
use Excel;


class ImportController extends Controller
{
    public function index()
    {
        return view('admin.pages.import');
    }

    public function import()
    {
        $file = public_path('upload') .'\\' . '111.xlsx'  ;

        $data = Excel::Import( new TransactionImport(), $file );


        dd($data);
    }
}
