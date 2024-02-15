<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;

class LogC extends Controller
{
    public function index(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Log'
        ]);
    
        $subtitle = "Daftar Aktivitas";
    
        $query = LogM::select('users.*', 'log.*')->join('users', 'users.id', '=', 'log.id_user');
    
        // Pencarian berdasarkan tanggal
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        if ($start_date) {
            $query->where('log.created_at', '>=', $start_date);
        }
    
        if ($end_date) {
            $query->where('log.created_at', '<=', $end_date . ' 23:59:59');
        }
    
        // Lakukan query
        $logM = $query->get();
    
        return view('log_index', compact('subtitle', 'logM'));
    }
    
}
