<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiUserController extends Controller
{
    public function index()
    {
        $transaksiUsers = TransaksiUser::with(['user', 'transaksi'])->get();
        return response()->json($transaksiUsers);
    }
}
