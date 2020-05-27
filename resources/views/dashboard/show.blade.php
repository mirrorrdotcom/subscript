@extends("layouts.app")

@section("content")
    <x-page-container class="py-4">
        <h1 class="font-display font-bold text-2xl text-gray-700">Welcome, {{ $user->first_name }}!</h1>
        <form action="{{ route("auth.logout") }}" method="post">
            @csrf
            <button class="w-full flex items-center py-1 px-2 text-sm text-blue-400 hover:bg-blue-100 rounded fastest-transition focus:outline-none mb-1">
                <i class="uil uil-exit mr-1"></i>
                <span class="">Logout</span>
            </button>
        </form>
    </x-page-container>
@endsection
