<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            $transaksi = Pembayaran::with('transaksi.rute.user')->whereHas('transaksi.rute.user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })->get();

            // return $transaksi;

            return view('agent-travel/invoice', [
                "title" => "Travel Agents",
                "invoices" => $transaksi
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(Pembayaran $pembayaran)
    {
        try {
            $user = auth()->user();
            if ($pembayaran->transaksi->rute->user->id === $user->id) {
                $pembayaran->transaksi->delete();
                $pembayaran->delete();

                return redirect('agent-travel/invoice')->with('success', 'Invoice deleted successfully');
            } else {
                return redirect('agent-travel/invoice')->with('error', 'Unauthorized access');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
