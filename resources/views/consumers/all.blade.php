@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('consumers.all') }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <div class="flex items-center justify-between mb-4 md:mb-6">
            <h1 class="font-display font-bold text-2xl text-gray-700">API Consumers</h1>
            <a href="{{ route("consumers.create") }}" class="btn success">
                <i class="uil uil-plus mr-1/4"></i>
                New Consumer
            </a>
        </div>
        @if(! $consumers->count())
            <p class="py-6 font-body text-gray-400 text-center leading-none">
                <i class="uil uil-desert text-2xl leading-none mr-1/2"></i>
                You do not have any consumers. To create one, click on the New button.
            </p>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($consumers as $item)
                <div class="flex flex-col justify-between px-5 py-4 bg-white shadow-md rounded hover:shadow-xl fastest-transition">
                    <div class="flex-grow-1 flex-shrink-0">
                        <p class="text-xs mb-3">
                            <i class="uil uil-clock leading-none text-orange-500 mr-1/2"></i><span class="text-gray-400">{{ humanize($item->created_at) }}</span>
                        </p>
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-display font-semibold text-gray-500 text-lg">{{ $item->name }}</h3>
                            <span class="circle {{ $item->is_active ? "bg-green-500" : "bg-red-400" }}"></span>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between mt-4">
                        <form action="{{ route("consumers.destroy", [ "consumer" => $item->id ]) }}" method="post">
                            @csrf
                            @method("delete")
                            <delete-button></delete-button>
                        </form>
                        <a href="{{ route("consumers.edit", [ "consumer" => $item->id ]) }}"
                           class="text-sm text-gray-400 hover:text-blue-500 hover:no-underline fastest-transition">
                            <i class="uil uil-edit mr-1/2"></i>Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </x-page-container>
@endsection
