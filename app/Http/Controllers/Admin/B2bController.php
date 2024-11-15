<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\B2b;

class B2bController extends Controller
{
    public function index()
    {
        $b2cData = B2b::with('country')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.data.b2b', compact('b2bData'));
    } 

}
