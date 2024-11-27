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

        return view('user.data.b2b', [
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

        return view('user.data.b2c', [
            'data' => $data,
            'pays' => $pays,
            'type' => 'b2c',
            'message' => $message
        ]);
    }

//     public function deleteData(Request $request, $pays, $type, $id)
// {
//     if ($type === 'b2b') {
//         $data = B2B::findOrFail($id);
//     } else if ($type === 'b2c') {
//         $data = B2C::findOrFail($id);
//     }
    
//     $data->delete();
    
//     return redirect()->back()->with('success', 'Enregistrement supprimé avec succès');
// }

// public function showEditForm(Request $request, $pays, $type, $id)
// {
//     $pays = Pays::where('name', $pays)->firstOrFail();
    
//     if ($type === 'b2b') {
//         $data = B2B::findOrFail($id);
//     } else if ($type === 'b2c') {
//         $data = B2C::findOrFail($id);
//     }
    
//     return view("admin.data.edit-{$type}", compact('pays', 'type', 'data'));
// }

// public function updateData(Request $request, $pays, $type, $id)
// {
//     if ($type === 'b2b') {
//         $data = B2B::findOrFail($id);
//         $validated = $request->validate([
//             'raison_social' => 'nullable|string|max:255',
//             'dirigeant_prenom' => 'nullable|string|max:255',
//             'dirigeant_name' => 'nullable|string|max:255',
//             'address' => 'nullable|string|max:255',
//             'postal_code' => 'nullable|string|max:255',
//             'ville' => 'nullable|string|max:255',
//             'phone' => 'required|string|max:255',
//             'gsm' => 'nullable|string|max:255',
//         ]);
//     } else if ($type === 'b2c') {
//         $data = B2C::findOrFail($id);
//         $validated = $request->validate([
//             'first_name' => 'nullable|string|max:255',
//             'last_name' => 'nullable|string|max:255',
//             'address' => 'nullable|string|max:255',
//             'postal_code' => 'nullable|string|max:255',
//             'ville' => 'nullable|string|max:255',
//             'phone' => 'required|string|max:255',
//             'gsm' => 'nullable|string|max:255',
//         ]);
//     }
    
//     $data->update($validated);
    
//     return redirect()->route('admin.pays.' . $type, ['pays' => $pays])
//                     ->with('success', 'Enregistrement mis à jour avec succès');
// }



}