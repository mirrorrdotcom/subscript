@extends("layouts.app")

@section("content")
    <x-page-container class="py-5">
        <div class="flex items-center justify-between mb-4 md:mb-6">
            <h1 class="font-display font-bold text-2xl text-gray-700">
                @yield("title")
            </h1>
            @yield("action-button")
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="flex items-start flex-col w-full md:w-4/12 lg:w-2/12">
                <a href="{{ route("consumers.edit", [ "consumer" => $consumer->id ]) }}"
                   class="flex items-center px-2 text-sm hover:text-blue-500 mb-3 {{ request()->routeIs("consumers.edit") ? "text-blue-500" : "text-gray-500" }}">
                    <i class="uil uil-notes mr-1/2 leading-none"></i>
                    General
                </a>
                <a href="{{ route("consumers.permissions.edit", [ "consumer" => $consumer->id ]) }}"
                   class="flex items-center px-2 text-sm hover:text-blue-500 mb-3 {{ request()->routeIs("consumers.permissions.edit") ? "text-blue-500" : "text-gray-500" }}">
                    <i class="uil uil-key-skeleton-alt mr-1/2 leading-none"></i>
                    Permissions
                </a>
            </div>
            <div class="w-full md:w-8/12 lg:w-10/12">
                @yield("consumer-content")
            </div>
        </div>
    </x-page-container>
@endsection
