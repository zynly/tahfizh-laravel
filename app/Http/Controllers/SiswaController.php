<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Ustad;
use App\Models\Murojaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        $siswas = Siswa::with('kelas')->orderByDesc('id')->paginate(10);
        // dd($user->ustad());
        $siswastatus   = null;

        if($user->siswa()->exists()){
            $isSiswaActive = $user->siswa->is_active;
            $siswastatus = $isSiswaActive ? 'Active' : 'Pending';
        } 
        return view('admin.siswas.index',compact('siswas'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        // Ambil query pencarian dari request
        $search = $request->input('search');

        // Query untuk mencari data ustad berdasarkan nama user atau nomor telepon
        $siswas = Siswa::whereHas('user', function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }
        })
        ->orderByDesc('id')
        ->paginate(10);

        // Mengirimkan query pencarian ke view untuk ditampilkan kembali di input form
        $siswas->appends(['search' => $search]);

        $siswaStatus = null;

        if($user->siswa()->exists()){
            $issiswaActive = $user->siswa->is_active;
            $siswaStatus = $issiswaActive ? 'Active' : 'Pending';
        }

        return view('admin.siswas.index', compact('siswas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        $ustad = Ustad::all();
        // dd($ustad);
        return  view('admin.siswas.create',compact('kelas','ustad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar'  => ['required','image','mimes:png,jpg,jpeg'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:6'],
            'kelas_id' => ['required','integer'],
            'ustad_id' => ['required','integer'],
        ]);

        if($request->hasFile('avatar')){
            $avatarPath = $request->file('avatar')->store('avatars','public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
        ]);

        // Assign role 'siswa' ke user
        $user->assignRole('siswa'); // Pastikan role 'siswa' sudah dibuat di database

        // Simpan data ke tabel siswas
        $siswanya = Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $request->kelas_id,
            'is_active' => $request->has('is_active'),
        ]);

         // Simpan data ke tabel siswas
         Murojaah::create([
            'siswa_id' => $siswanya->id,
            'ustad_id' => $request->ustad_id,
        ]);

        return redirect()->route('admin.siswas.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        $ustads = Ustad::all();
        // dd($ustad);
        return  view('admin.siswas.edit',compact('kelas','ustads','siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        // Validasi data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$siswa->user_id], // Pastikan email unik, kecuali email dari user yang sedang di-update
            'password' => ['nullable', 'string', 'min:6'],
            'kelas_id' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
            'ustad_id' => ['required','integer'],
        ]);


         // Jika ada file avatar, lakukan update avatar
        if($request->hasFile('avatar')){
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            // Jika tidak ada avatar yang di-upload, gunakan avatar yang sudah ada
            $avatarPath = $siswa->user->avatar;
        }

          // Update data user
        $siswa->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatarPath,
            // Update password hanya jika diisi
            'password' => $request->password ? Hash::make($request->password) : $siswa->user->password,
        ]);

        // Update data siswa
        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'is_active' => $request->is_active,
        ]);

        // Update atau buat baru di tabel murojaahs
        Murojaah::updateOrCreate(
            ['siswa_id' => $siswa->id], // Kondisi: update berdasarkan siswa_id
            ['ustad_id' => $request->ustad_id] // Data baru atau yang akan di-update
        );
        
        return redirect()->route('admin.siswas.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        // Hapus data siswa, otomatis juga akan menghapus data di tabel murojaahs karena event deleting
        $siswa->delete();

        return redirect()->route('admin.siswas.index');
    }
}
