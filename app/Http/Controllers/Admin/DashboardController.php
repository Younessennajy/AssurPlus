<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\B2B;
use App\Models\B2C;
use App\Models\Pays;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupération des statistiques globales
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $activeUsers = User::whereNotNull('email_verified_at')->count();

        $totalB2B = B2B::count();
        $totalB2C = B2C::count();
        $totalPays = Pays::count();

        // Récupération des données par pays
        $paysStats = Pays::all()->map(function ($pay) {
            return [
                'name' => $pay->name,
                'indicatif' => $pay->indicatif,
                'b2b_count' => B2B::where('pays_id', $pay->id)->count(),
                'b2c_count' => B2C::where('pays_id', $pay->id)->count(),
            ];
        });

        // Préparation des données pour le graphique
        $paysChartData = Pays::all()->map(function ($pay) {
            return [
                'name' => $pay->name,
                'b2b_count' => B2B::where('pays_id', $pay->id)->count(),
                'b2c_count' => B2C::where('pays_id', $pay->id)->count(),
            ];
        });

        // Retourner les données à la vue
        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsersToday',
            'activeUsers',
            'totalB2B',
            'totalB2C',
            'totalPays',
            'paysStats',
            'paysChartData'
        ));
    }
}
