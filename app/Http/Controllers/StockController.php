<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('stock');
    }

    public function store(Request $request)
    {
        if ($request['id']) {
            $stock = Stocks::find($request['id']);

            $stock->product_id = $request['prduct_id'];
            $stock->amount = $request['amount'];
            $stock->save();

        } else {
            Stocks::create([
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
            ]);

        }
        return view('stock');
    }

    public function show($id)
    {
        return response()->json(Stocks::find($id));
    }

    public function delete()
    {
        Stocks::query()->delete();
        return redirect()->route('stock');
    }
}
