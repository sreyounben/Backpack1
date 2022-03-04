<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $customers = Customer::paginate(5);
        return CustomerResource::collection($customers);
    }
    public function store(Request $request)
    {

        return Customer::create($request->all());
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return new CustomerResource($customer);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        Customer::find($id)->update( $request->all());
        return (['success','data update success']);
    }
    public function destroy($id)
    {
        Customer::destroy($id);
        return ['message' => "Record deleted."];
    }
}
