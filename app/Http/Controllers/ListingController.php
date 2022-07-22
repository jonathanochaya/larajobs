<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all lists
    public static function index()
    {
        return view('listings.index', [
            'listings' => Listing::filter(request(['tag', 'search']))->latest()->simplePaginate(2)
        ]);
    }

    // show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // create new job listing
    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => ['required', 'url'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->has('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);
        return redirect(@route('home'))->with('message', 'Listing created successfully');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Listing $listing, Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required|url',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->has('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', "Listing succesfully updated!");
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect(@route('home'))->with('message', 'Listing successfully deleted');
    }
}
