<?php

namespace App\Http\Controllers;

use App\Models\Murojaah;
use Illuminate\Http\Request;
use App\Models\HistoryMurojaah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHistoryMurojaahRequest;

class HistoryMurojaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $user = Auth::user();

        $murojaahnya = HistoryMurojaah::with('murojaah')->orderByDesc('id');

        if($user->hasRole('siswa')){
            $murojaahnya->whereHas('siswa', function ($query) use ($user){
                $query->where('user_id',$user->id); 
            });
        }
        $historynya = $murojaahnya->paginate(10);
 */
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
        $historynya = $murojaahnya->paginate(10);

        return view('admin.historymurojaahs.index',compact('historynya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function cari()
    {
        return view('admin.historymurojaahs.cari');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistoryMurojaahRequest $request, Murojaah $murojaah)
    {
        
        try {
        DB::transaction(function() use ($request, $murojaah){
            $validated = $request -> validated();
            $validated['murojaah_id'] = $murojaah->id;

            
            $murojaah->history()->create($validated);
        });

        return redirect()->route('admin.murojaahs.show',$murojaah->id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        // Ambil input tanggal dari request
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Query berdasarkan rentang tanggal
        $historyMurojaahs = HistoryMurojaah::query();

        // Cek apakah input tanggal mulai ada
        if ($fromDate) {
            $historyMurojaahs->whereDate('tgl_murojaah', '>=', $fromDate);
        }

        // Cek apakah input tanggal akhir ada
        if ($toDate) {
            $historyMurojaahs->whereDate('tgl_murojaah', '<=', $toDate);
        }

        // Ambil data dengan urutan terbaru
        $historyMurojaahs = $historyMurojaahs->orderBy('tgl_murojaah', 'desc')->get();

        // Kirim data ke view
        return view('admin.historymurojaahs.hasiltanggal', compact('historyMurojaahs'));
    }


    /**
     * Display the specified resource.
     */
    public function show(HistoryMurojaah $historyMurojaah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryMurojaah $historyMurojaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistoryMurojaah $historyMurojaah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryMurojaah $historyMurojaah)
    {
        //
    }
}
