<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function markAllRead()
    {
        Notifikasi::where('user_id', Auth::id())->where('dibaca', false)->update(['dibaca' => true]);
        return back();
    }
}