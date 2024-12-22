<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return  view('admin.kelas.index',compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasRequest $request)
    {
        //DB::transaction ini memastikan data masuk semua, kl ada tidak lengkap maka otomatis di rollback
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            if($request->hasFile('icon')){
                $iconPath = $request->file('icon')->store('icons','public');
                $validated['icon'] = $iconPath;
            }else{
                $iconPath = 'images/icon-kelas-default.png';
            }

            $validated['slug']  = Str::slug($request->name);
            $kelas    = Kelas::create($validated);
            
        });

        return  redirect()->route('admin.kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return  view('admin.kelas.edit',compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        DB::transaction(function() use ($request, $kelas){
            $validated = $request->validated();

            if($request->hasFile('icon')){
                $iconPath = $request->file('icon')->store('icons','public');
                $validated['icon'] = $iconPath;
            }else{
                $iconPath = 'images/icon-kelas-default.png';
            }

            $validated['slug']  = Str::slug($request->name);
            
            $kelas->update($validated);
            
        });

        return  redirect()->route('admin.kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        DB::beginTransaction();
        try {
            $kelas->delete();
            DB::commit();
            return redirect()->route('admin.kelas.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.kelas.index');
        }
    }
}
