<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = customer::all();
        return view("dashbord.layout.User_Crud.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashbord.layout.User_Crud.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $customer = new customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = $request->password;
        $customer->save();

         return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $customer = customer::findorFail($id);
        return view('dashbord.layout.User_Crud.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
         $customer = customer::findorFail($id);
         $customer->name = $request->name;
         $customer->email = $request->email;
         $customer->phone = $request->phone;
        $customer->password = $request->password;
         $customer->save();
        return redirect()->route('customer.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
         customer::destroy($id);
        return redirect()->route('customer.index');
    }
}
