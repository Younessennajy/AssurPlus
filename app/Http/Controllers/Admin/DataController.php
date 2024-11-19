<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pays;

class DataController extends Controller
{
    public function pays()
    {
        $pays = Pays::all();
        return view('admin.layouts.sidebar', compact('pays'));
    }
    public function showB2BData(Request $request, $pays)
    {
        $pays = Pays::where('name', $pays)->firstOrFail();
        $query = $pays->b2bs();
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        if ($request->has('filter_status') && $request->get('filter_status') !== '') {
            $query->where('status', $request->get('filter_status'));
        }
        $data = $query->paginate(10);
        return view('admin.data.show', [
            'data' => $data,
            'pays' => $pays,
            'type' => 'b2b'
        ]);
    }
    public function showB2CData(Request $request, $pays)
    {
        $pays = Pays::where('name', $pays)->firstOrFail();
        $query = $pays->b2cs();
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        if ($request->has('filter_status') && $request->get('filter_status') !== '') {
            $query->where('status', $request->get('filter_status'));
        }
        $data = $query->paginate(10);
        return view('admin.data.show', [
            'data' => $data,
            'pays' => $pays,
            'type' => 'b2c'
        ]);
    }
}