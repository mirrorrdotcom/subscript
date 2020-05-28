<div class="w-full py-3 bg-white border-b border-gray-100">
    <x-page-container class="flex items-center justify-between">
        <a href="{{ route("dashboard") }}"
           class="font-display font-semibold text-lg text-gray-400 leading-none no-underline hover:text-gray-500 hover:no-underline cursor-pointer">
            <i class="uil uil-receipt text-orange-500 hover:text-orange-500"></i>
            {{ config("app.name", "Subscript") }}
        </a>
        <nav class="flex items-center p-0">
            <a href="{{ route("subscription-models.all") }}" class="nav-item">
                <i class="uil uil-box mr-1/2"></i>
                Models
            </a>
            <form action="{{ route("auth.logout") }}" method="post">
                @csrf
                <button class="flex items-center px-2 text-sm text-red-300 hover:text-red-700 focus:outline-none">
                    <i class="uil uil-exit mr-1/2"></i>
                    <span class="">Logout</span>
                </button>
            </form>
        </nav>
    </x-page-container>
</div>
