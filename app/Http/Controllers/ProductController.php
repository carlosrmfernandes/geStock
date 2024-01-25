<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Stocks;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('product');
    }

    public function store(Request $request)
    {
        if($request['id']){
            $product = Products::find($request['id']);

            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->amount = $request['amount'] + Stocks::where('product_id', $request['id'])->sum('amount');
            $product->save();

        }else{
            Products::create([
                'name' => $request['name'],
                'price' => $request['price'],
                'amount' => $request['amount']
            ]);

        }
        return view('product');
    }

    public function show($id)
    {
        $product = Products::find($id);
        $product->amount = $product->amount - Stocks::where('product_id', $id)->sum('amount');
        return response()->json($product);
    }

    public function delete($id)
    {
        Products::where('id',$id)->delete();
        return redirect()->route('product');
    }
}
