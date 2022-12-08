<x-layout>
    @include('partials/_hero')
    @include('partials/_search')

    @unless(empty($listings))
        @foreach($listings as $list)
            <x-listing-card :listing="$list" />
        @endforeach
    @else
        <span>Nothing has been found</span>
    @endunless
</x-layout>
