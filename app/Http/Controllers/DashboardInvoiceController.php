<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Notifikasi;
use App\Models\Order;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardInvoiceController extends Controller
{

    public function index()
    {
        return view('dashboard.invoices.index', [
            'invoices' => Invoice::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.invoices.create', [
            'orders' => Order::where('is_surveyed', '1')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required',
            'created_by' => 'required',
            'total_price_product' => 'required',
            'description' => 'required',
            'fileAsset' => 'required|file|max:10240'
        ]);

        $validatedData['total_price_product'] = str_replace(".", "", $request->total_price_product);

        $file = $request->file('fileAsset');
        $name = $file->getClientOriginalName();

        if ($request->file('fileAsset')) {
            $validatedData['fileAsset'] = $request->file('fileAsset')->storeAs('invoice-files', $name);
        }

        Invoice::create($validatedData);
        Notifikasi::createNotification('admin', 'invoice');

        Order::where('id', $request->order_id)->update(['is_invoice_sent' => 1]);

        return redirect('/dashboard/invoices')->with('success', 'Invoice baru sudah ditambahkan');
    }

    public function show(Invoice $invoice)
    {
        return view('dashboard.invoices.show', [
            'invoice' => $invoice,
            'survey' => Survey::where('order_id', $invoice->order_id)->first(),
        ]);
    }

    public function edit(Invoice $invoice)
    {
        return view('dashboard.invoices.edit', [
            'invoice' => $invoice,
            'orders' => Order::where('is_surveyed', '1')->get(),
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'created_by' => 'required',
            'total_price_product' => 'required',
            'description' => 'required',
            'fileAsset' => 'file|max:10240'
        ]);

        $validatedData['total_price_product'] = str_replace(".", "", $request->total_price_product);


        if ($request->file('fileAsset')) {
            $file = $request->file('fileAsset');
            dd($file);
            $name = $file->getClientOriginalName();
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['fileAsset'] = $request->file('fileAsset')->storeAs('invoice-files', $name);
        }

        Invoice::where('id', $invoice->id)->update($validatedData);

        return redirect('/dashboard/invoices')->with('success', 'Invoice sudah diubah');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->fileAsset) {
            Storage::delete($invoice->fileAsset);
        }
        Invoice::destroy($invoice->id);

        return redirect('/dashboard/invoices')->with('success', 'Invoice sudah dihapus!');
    }

    public function checkOrder(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        return response()->json([
            'name' => $order->user->name,
        ]);
    }

    public function downloadFile($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $path = $invoice->fileAsset;
        return Storage::download($path);
    }

    public function validationInvoice(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'is_validated' => 'required',
        ]);

        Invoice::where('id', $invoice->id)->update($validatedData);

        return redirect('/dashboard/invoices')->with('success', 'Invoice sudah divalidasi');
    }
}
