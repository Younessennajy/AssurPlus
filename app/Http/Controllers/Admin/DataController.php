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
        $message = null;

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('raison_social', 'like', "%{$search}%")
                  ->orWhere('dirigeant_prenom', 'like', "%{$search}%")
                  ->orWhere('dirigeant_name', 'like', "%{$search}%")
                  ->orWhere('ville', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(10);
        
        if ($request->has('search') && $data->isEmpty()) {
            $message = "Aucun résultat trouvé pour votre recherche.";
        }

        return view('admin.data.b2b', [
            'data' => $data,
            'pays' => $pays,
            'type' => 'b2b',
            'message' => $message
        ]);
    }

    public function showB2CData(Request $request, $pays)
    {
        $pays = Pays::where('name', $pays)->firstOrFail();
        $query = $pays->b2cs();
        $message = null;

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('ville', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $data = $query->paginate(10);

        if ($request->has('search') && $data->isEmpty()) {
            $message = "Aucun résultat trouvé pour votre recherche.";
        }

        return view('admin.data.b2c', [
            'data' => $data,
            'pays' => $pays,
            'type' => 'b2c',
            'message' => $message
        ]);
    }
}