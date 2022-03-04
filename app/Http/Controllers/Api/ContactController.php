<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\API\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::paginate(7);
        return ContactResource::collection($contacts);
    }

    public function store(Request $request)
    {
        return Contact::create($request->all());
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return new ContactResource($contact);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
