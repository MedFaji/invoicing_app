<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Exception;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $invoices = Invoice::with('customer')
                ->orderBy('id', 'DESC')->get();
            return response()->json([
                'invoices' => $invoices
            ], 200);

        } catch (Exception $e) {
            response()->json($e);
        }

    }

    public function searchInvoice(Request $request)
    {

        try {
            $search = $request->get('s');
            if ($search !== null) {
                $invoices = Invoice::with('customer')
                    ->where('id', 'LIKE', "%$search%")
                    ->get();
                return response()->json([
                    'invoices' => $invoices
                ], 200);
            } else {
                return $this->index();
            }
        }catch (Exception $e) {
            return response()->json($e);
        }


    }
}
