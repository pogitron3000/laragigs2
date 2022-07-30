<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingsController extends Controller
{
    public function index() {
        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    public function show(Listings $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create() {
        return view('listings.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'tags' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields = $request->file('logo')->store('logos', 'public');

        }
        Listings::create($formFields);
        return redirect('/')->with('message', 'Listing Successfully created');
    }
}
