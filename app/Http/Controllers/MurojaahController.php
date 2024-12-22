<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Murojaah;
use Illuminate\Http\Request;
use App\Models\HistoryMurojaah;
use Illuminate\Support\Facades\Auth;

class MurojaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $murojaahnya = Murojaah::with('siswa','ustad')->orderByDesc('id');

        if($user->hasRole('ustad')){
            $murojaahnya->whereHas('ustad', function ($query) use ($user){
                $query->where('user_id',$user->id); 
            });
        }
        $murojaahs = $murojaahnya->paginate(10);

        return view('admin.murojaahs.index',compact('murojaahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Murojaah $murojaah)
    {
        $surat = Surat::all();
        $historynya = HistoryMurojaah::where('murojaah_id', $murojaah->id)->get();
        return view('admin.murojaahs.show',compact('murojaah','surat','historynya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Murojaah $murojaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Murojaah $murojaah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Murojaah $murojaah)
    {
        //
    }
}
