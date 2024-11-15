<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\B2c;

class B2cController extends Controller
{
    public function index()
    {
        $b2cData = B2c::with('country')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.data.b2c', compact('b2cData'));
    } 

   
}
