<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class UsersR extends Controller
{

    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Pengguna'
        ]);
        $subtitle = "Daftar Pengguna";
        $UsersM = User::all();
        return view('users.users_index', compact('subtitle', 'UsersM'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Pengguna'
        ]);
        $subtitle = "Tambah Pengguna";
        return view('users.users_create', compact('subtitle'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah Pengguna'
        ]);
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required'
        ]);

        $user = new User([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $user->save();

        return redirect()->route('users.store')->with('success', 'Pengguna Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Pengguna'
        ]);
        $subtitle = "Edit Data Pengguna";
        $data = User::find($id);
        return view('users.users_edit', compact('subtitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Pengguna'
        ]);
        $request->validate([
            'nama' => 'required',
            // 'username' => 'required',
            'role' => 'required'
        ]);
   
        $data = request()->except(['_token', '_method', 'submit']);
   
        User::where('id', $id)->update($data);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus User'
        ]);
        User::where('id', $id)->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
    }

    public function changepassword($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Ganti Kata Sandi Pengguna'
        ]);
        $subtitle = "Edit Kata Sandi Pengguna";
        $data = User::find($id);
        return view('users.users_changepassword', compact('subtitle', 'data'));
    }

    public function change(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Ganti Kata Sandi Pengguna'
        ]);
        $request->validate([
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new',
        ]);
        $users = User::where("id", $id)->first();
        $users->update([
            'password' => Hash::make($request->password_new),
        ]);
        return redirect()->route('users.index')->with('success', 'Kata Sandi Pengguna Berhasil Diperbaharui');
    }

    public function pdf()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat Laporan Pengguna'
        ]);

        $User = User::all();

        $pdf = 'PDF'::loadview('users.users_pdf', ['User' => $User]);
        return $pdf->stream('users.pdf');
    }

    
}
