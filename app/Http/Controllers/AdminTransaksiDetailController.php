<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class AdminTransaksiDetailController extends Controller
{
    function create(Request $request)
    {
        $produk_id = $request->produk_id;
        $transaksi_id = $request->transaksi_id;

        // Find Transaksi record with error handling
        $transaksi = Transaksi::find($transaksi_id);

        if (!$transaksi) {
            // Handle the case where no matching Transaksi is found
            return redirect('/')->with('error', 'Transaction not found'); // Or provide a more informative error message
        }

        $td = TransaksiDetail::whereProdukId($produk_id)
                            ->whereTransaksiId($transaksi_id)
                            ->first();

        if ($td == null) {
            $data = [
                'produk_id' => $produk_id,
                'produk_name' => $request->produk_name,
                'transaksi_id' => $transaksi_id,
                'qty' => $request->qty,
                'subtotal' => $request->subtotal,
            ];

            TransaksiDetail::create($data);
            $transaksi->total += $request->subtotal;
        } else {
            $data = [
                'qty' => $td->qty + $request->qty,
                'subtotal' => $td->subtotal + $request->subtotal,
            ];
            $td->update($data);
            $transaksi->total += $request->subtotal;
        }

        $transaksi->save(); // Use save() for potential database-level validations

        return redirect('/admin/transaksi/'.$transaksi_id.'/edit');
    }

    function delete()
    {
        $id = request('id');
        $td = TransaksiDetail::find($id);

        if (!$td) {
            // Handle the case where no TransaksiDetail is found
            return redirect('/')->with('error', 'Transaction Detail not found');
        }

        $transaksi = Transaksi::find($td->transaksi_id);

        if (!$transaksi) {
            // Handle the case where no Transaksi is found
            return redirect('/')->with('error', 'Transaction not found');
        }

        $transaksi->total -= $td->subtotal;
        $transaksi->save(); // Use save() for potential database-level validations

        $td->delete();

        return redirect()->back();
    }

    function done($id)
    {
        $transaksi = Transaksi::find($id);
        $data = [
            'status' => 'selesai',
        ];
        $transaksi->update($data);
        return redirect('admin/transaksi');
    }
}
