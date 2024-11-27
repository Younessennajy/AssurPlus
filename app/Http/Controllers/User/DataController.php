<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pays;
use App\Models\B2B;
use App\Models\B2C;

class DataController extends Controller
{
    public function pays()
    {
        $pays = Pays::all();
        return view('layouts.sidebar', compact('pays'));
    }
    public function showB2BData(Request $request, $pays) 
{
    $pays = Pays::where('name', $pays)->firstOrFail();
    $query = $pays->b2bs();
    $message = null;
    
    // Ajout du tri
    $sortColumn = $request->get('sort', 'id');
    $sortDirection = $request->get('direction', 'asc');
    
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

    $data = $query->orderBy($sortColumn, $sortDirection)->paginate(10);
    
    if ($request->has('search') && $data->isEmpty()) {
        $message = "Aucun résultat trouvé pour votre recherche.";
    }

    return view('user.data.b2b', [
        'data' => $data,
        'pays' => $pays,
        'type' => 'b2b',
        'message' => $message,
        'sortColumn' => $sortColumn,
        'sortDirection' => $sortDirection
    ]);
}

public function showB2CData(Request $request, $pays)
{
    $pays = Pays::where('name', $pays)->firstOrFail();
    $query = $pays->b2cs();
    $message = null;
    
    // Ajout du tri
    $sortColumn = $request->get('sort', 'id');
    $sortDirection = $request->get('direction', 'asc');

    if ($request->has('search')) {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('ville', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    $data = $query->orderBy($sortColumn, $sortDirection)->paginate(10);

    if ($request->has('search') && $data->isEmpty()) {
        $message = "Aucun résultat trouvé pour votre recherche.";
    }

    return view('user.data.b2c', [
        'data' => $data,
        'pays' => $pays,
        'type' => 'b2c',
        'message' => $message,
        'sortColumn' => $sortColumn,
        'sortDirection' => $sortDirection
    ]);
}

    



}