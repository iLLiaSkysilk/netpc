<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $validator = Validator::make($request->all(), [
		    'name' => 'required|max:255|min:2',
		    'surname' => 'required|max:255|min:2',
		    'email' => 'required|email|unique:contacts,email',
		    'phone_number' => 'required|min:6|max:15',
		    'address' => 'required|max:255',
		    'dob' => 'date_format:"Y-m-d"|required',
	    ]);
	    if ($validator->fails()) {
		    return response()->json(['errors'=>$validator->errors(), 'status' => 404]);
	    }
	    $contact = new Contact();
	    $contact->setAttribute('name', $request->get('name'));
	    $contact->setAttribute('surname', $request->get('surname'));
	    $contact->setAttribute('email', $request->get('email'));
	    $contact->setAttribute('phone_number', $request->get('phone_number'));
	    $contact->setAttribute('address', $request->get('address'));
	    $contact->setAttribute('dob', $request->get('dob'));
	    $contact->save();
	    return response()->json(['errors'=> null, 'status' => 200]);
    }

	/**
	 * Update the specified resource in storage.
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return JsonResponse
	 */
    public function update(Request $request, int $id) : JsonResponse
    {
	    $validator = Validator::make($request->all(), [
		    'name' => 'required|max:255|min:2',
		    'surname' => 'required|max:255|min:2',
		    'email' => 'required|email|unique:contacts,email,'.$id,
		    'phone_number' => 'required|min:6|max:15',
		    'address' => 'required|max:255',
		    'dob' => 'date_format:"Y-m-d"|required',
	    ]);
	    if ($validator->fails()) {
		    return response()->json(['errors'=>$validator->errors(), 'status' => 404]);
	    }
	    $contact = Contact::find($id);
	    $contact->name = $request->get('name');
	    $contact->surname = $request->get('surname');
	    $contact->email = $request->get('email');
	    $contact->phone_number = $request->get('phone_number');
	    $contact->address = $request->get('address');
	    $contact->dob = $request->get('dob');
	    $contact->save();
	        return response()->json(['errors'=> null, 'status' => 200]);
    }

	/**
	 * Remove the specified resource from storage.
	 * @param Request $request
	 * @internal param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function destroy(Request $request)
    {
	    Contact::destroy($request->get('contact_id'));
	    return redirect()->back();
    }
}
