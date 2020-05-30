@if (count($breadcrumbs))
    <x-page-container class="mt-4">
        <div class="flex">
            @foreach ($breadcrumbs as $k => $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <span class="text-sm text-gray-500"><a href="{{ $breadcrumb->url }}" class="hover:underline">{{ $breadcrumb->title }}</a><span class="mx-1 text-gray-400">/</span></span>
                @else
                    <span class="text-sm text-gray-400"> {{ $breadcrumb->title }}</span>
                @endif
            @endforeach
        </div>
    </x-page-container>
@endif
