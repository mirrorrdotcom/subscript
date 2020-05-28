@extends("layouts.app")

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700">Welcome, {{ $user->first_name }}!</h1>
    </x-page-container>
@endsection
