<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\List_;

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
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }
        Listings::create($formFields);
        return redirect('/')->with('message', 'Listing Successfully created');
    }

    public function edit(Listings $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listings $listing) {
        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        }
        $listing->update($formFields);
        return redirect('/')->with('message', 'Listing Successfully Updated');
    }

    public function destroy(Listings $listing) {
        $listing->delete();

        return redirect('/')->with('message', 'Listing Successfully Deleted');
    }
}
