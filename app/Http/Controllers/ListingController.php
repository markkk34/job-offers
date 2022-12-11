<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Homepage
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
//        dd(Listing::latest()
//            ->filter(request(['tag', 'search']))
//            ->paginate(2));
        return view(
            'listings.index',
            [
                'listings' =>
                    Listing::latest()
                        ->filter(request(['tag', 'search']))
                        ->paginate(5),
            ]
        );
    }

    /**
     * Single listing
     *
     * @param Listing $listing
     * @return Application|Factory|View
     */
    public function show(Listing $listing): View|Factory|Application
    {
        return view(
            'listings.show',
            [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Represents form for adding
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('listings.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'       => 'required',
            'company'     => ['required', Rule::unique('listings', 'company')],
            'location'    => 'required',
            'email'       => ['required', 'email'],
            'website'     => ['required', 'url'],
            'tags'        => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($data);

        return redirect()->route('homepage')->with('success', 'Ur post has been added');
    }

    /**
     * @param Listing $listing
     * @return Application|Factory|View
     */
    public function edit(Listing $listing): View|Factory|Application
    {
        return view(
            'listings.edit',
            [
                'listing' => $listing,
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        $data = $request->validate([
            'title'       => 'required',
            'company'     => ['required'],
            'location'    => 'required',
            'email'       => ['required', 'email'],
            'website'     => ['required', 'url'],
            'tags'        => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($data);

        return back()->with('success', 'Ur post has been updated');
    }
}
