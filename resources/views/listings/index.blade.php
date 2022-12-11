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
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</x-layout>
