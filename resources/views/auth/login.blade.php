@extends("layouts.app")

@section("content")
    <div class="w-full h-screen flex items-start justify-center">
        <div class="w-full md:w-2/3 xl:w-1/3 py-5 px-6 bg-white shadow-lg rounded mt-2 md:mt-10">
            <h1 class="font-display font-bold text-2xl text-gray-600 mb-2">Login</h1>
            <p class="font-body text-sm text-gray-400">Login to your account to start managing subscriptions and plans.</p>
            @error("error")
            <p class="text-red-500 text-sm font-body mt-2">
                <i class="uil uil-info-circle"></i>
                {{ $message }}
            </p>
            @enderror
            <form action="{{ route("auth.login.attempt") }}" method="post" class="mt-5">
                @csrf
                <x-form-input type="email"
                              name="email"
                              placeholder="e.g: johndoe@example.com"
                              label="Email Address"
                              icon="uil uil-envelope-alt"
                              value="{{ old('email') }}"
                              class="mb-4"></x-form-input>
                <x-form-input type="password"
                              name="password"
                              placeholder="Enter password here..."
                              label="Password"
                              icon="uil uil-lock"
                              class="mb-5"></x-form-input>
                <div class="w-full flex justify-end">
                    <button class="py-1 px-4 font-display font-bold uppercase text-white text-sm bg-green-500 hover:bg-green-400 rounded-full focus:outline-none">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
