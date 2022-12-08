<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Homepage
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view(
            'listings.index',
            [
                'listings' =>
                    Listing::latest()
                        ->filter(request(['tag', 'search']))
                        ->get(),
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
}
