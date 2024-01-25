<?php

namespace App\Http\Controllers;

use App\Models\Debts;
use Illuminate\Http\Request;

class DebtController extends Controller
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
        return view('debt');
    }

    public function store(Request $request)
    {
        if ($request['id']) {
            $debt = Debts::find($request['id']);

            $debt->name = $request['name'];
            $debt->value = $request['value'];
            $debt->save();

        } else {
            Debts::create([
                'name' => $request['name'],
                'value' => $request['value'],
            ]);

        }
        return view('debt');
    }

    public function show($id)
    {
        return response()->json(Debts::find($id));
    }

    public function delete($id)
    {
        Debts::where('id', $id)->delete();
        return redirect()->route('debt');
    }
}
