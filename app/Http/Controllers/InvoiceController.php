<?php

namespace App\Http\Controllers;

use App\Models\Detpesanan;
use App\Models\Store;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 1) {
            $invoice = Invoice::with(['pesanan', 'user', 'store'])->get();
        } else {
            $store = Store::where('user_id', auth()->user()->id)->first();
            $invoice = Invoice::with(['pesanan', 'user', 'store'])->where('store_id', $store->id)->get();
        }

        $data = [
            'title' => 'Invoice',
            'invoice' => $invoice
        ];

        return view('invoice.index', $data);
    }

    public function detail(Invoice $invoice)
    {
        $invoice = Invoice::with(['pesanan.pengiriman'])->where('no_invoice', $invoice->no_invoice)->first();
        $data = [
            'title' => 'Detail Pesanan',
            'invoice' => $invoice,
            'detail' => Detpesanan::with(['produk'])->where('pesanan_id', $invoice->pesanan->id)->get()
        ];

        return view('invoice.detail_invoice', $data);
    }
}
