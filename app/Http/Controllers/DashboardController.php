<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Ustad;
use Illuminate\Http\Request;
use App\Models\HistoryMurojaah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /*  $user = Auth::user();
         $MurojaahsQuery = HistoryMurojaah::orderBy('created_at', 'desc');
       
        $historyMurojaahs =  $historyMurojaahs->limit(5)->get(); */

        $user = Auth::user();

        // Query awal
        $murojaahnya = HistoryMurojaah::with('murojaah')->orderByDesc('created_at');

        // Cek jika user yang login adalah siswa
        if ($user->hasRole('siswa')) {
            $murojaahnya->whereHas('siswa', function ($query) use ($user) {
                $query->where('user_id', $user->id); // Filter berdasarkan user_id siswa
            });
        }

        // Cek jika user yang login adalah ustad
        if ($user->hasRole('ustad')) {
            $murojaahnya->whereHas('murojaah', function ($query) use ($user) {
                $query->where('ustad_id', $user->ustad->id); // Filter berdasarkan ustad_id
            });
        }

        // Pagination
        $historyMurojaahs = $murojaahnya->limit(5)->get();


        $ustads = Ustad::count();
        $siswas = Siswa::count();
        return view('dashboard',compact('ustads','siswas', 'historyMurojaahs')); // Masih menggunakan view dashboard
    }
}
