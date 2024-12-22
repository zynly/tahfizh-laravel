<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ustad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUstadRequest;

class UstadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);
        $ustads = Ustad::orderByDesc('id')->paginate(10);
        // dd($user->ustad());
        $ustadStatus   = null;

        if($user->ustad()->exists()){
            $isustadActive = $user->ustad->is_active;
            $ustadStatus = $isustadActive ? 'Active' : 'Pending';
        } 
        return view('admin.ustads.index',compact('ustads'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        // Ambil query pencarian dari request
        $search = $request->input('search');

        // Query untuk mencari data ustad berdasarkan nama user atau nomor telepon
        $ustads = Ustad::whereHas('user', function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            }
        })
        ->orderByDesc('id')
        ->paginate(10);

        // Mengirimkan query pencarian ke view untuk ditampilkan kembali di input form
        $ustads->appends(['search' => $search]);

        $ustadStatus = null;

        if($user->ustad()->exists()){
            $isustadActive = $user->ustad->is_active;
            $ustadStatus = $isustadActive ? 'Active' : 'Pending';
        }

        return view('admin.ustads.index', compact('ustads', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.ustads.create');
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

        // Assign role 'ustad' ke user
        $user->assignRole('ustad'); // Pastikan role 'ustad' sudah dibuat di database

        // Simpan data ke tabel ustads
        Ustad::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
            'is_active' => $request->has('is_active'),
        ]);

        return  redirect()->route('admin.ustads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ustad $ustad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ustad $ustad)
    {
        return view('admin.ustads.edit', compact('ustad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, Ustad $ustad)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $ustad->user_id, // Pastikan email unik kecuali untuk user ini
            'password' => 'nullable|min:8', // Password boleh kosong, namun jika diisi harus minimal 8 karakter
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi avatar (jika ada)
            'phone_number' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        // Update data User terkait
        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        // Cek apakah password diisi, jika iya, update password
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }

        // Cek apakah ada file avatar yang diunggah
        if ($request->hasFile('avatar')) {
            // Simpan avatar ke storage dan update path-nya
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $userData['avatar'] = $avatarPath;
        }

        $ustad->user->update($userData);

        // Update data Ustad
        $ustad->update([
            'phone_number' => $request->input('phone_number'),
            'is_active' => $request->input('is_active', 0), // Jika tidak dicentang, default ke 0
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return  redirect()->route('admin.ustads.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ustad $ustad)
    {
        //
    }
}
