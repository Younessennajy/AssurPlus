<?php
// app/Http/Controllers/ColumnsController.php
namespace App\Http\Controllers;

use App\Models\B2b;
use App\Models\B2c;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; 

class ColumnsController extends Controller
{
    public function showColumns()
    {
        $pays = Pays::All(); 
        $b2bColumns = \Schema::getColumnListing('b2b');
        
        $b2cColumns = \Schema::getColumnListing('b2c');
        return view('admin.columns.show', compact('b2bColumns', 'b2cColumns','pays'));
    }
    public function addColumn(Request $request)
    {
        $request->validate([
            'type' => 'required|in:b2b,b2c',
            'column' => 'required|string|alpha_dash|unique_column:' . $request->type,
        ]);

        $table = $request->type;
        $column = $request->column;

        Schema::table($table, function ($table) use ($column) {
            $table->string($column)->nullable();
        });

        return redirect()->back()->with('success', 'Colonne ajoutée avec succès !');
    }
    public function deleteColumn(Request $request)
    {
        $request->validate([
            'type' => 'required|in:b2b,b2c',
            'column' => 'required|string',
        ]);

        $table = $request->type;
        $column = $request->column;

        if (!Schema::hasColumn($table, $column)) {
            return redirect()->back()->withErrors(['error' => 'La colonne spécifiée n’existe pas.']);
        }

        Schema::table($table, function ($table) use ($column) {
            $table->dropColumn($column);
        });

        return redirect()->back()->with('success', 'Colonne supprimée avec succès !');
    }
}