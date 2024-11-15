<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function b2b()
    {
        return view('admin.data.b2b');
    }   

    public function b2c()
    {
        return view('admin.data.b2c');
    }

    public function country()
    {
        return view('admin.data.country');
    }
}
