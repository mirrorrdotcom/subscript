@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render("audits.all") }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <div class="flex items-center justify-between ">
            <h1 class="font-display font-bold text-2xl text-gray-700">Audits</h1>
        </div>
        <div>
            @foreach($audits as $audit)
                <div class="pt-4 pb-2 border-b border-gray-200 fastest-transition">
                    <div class="flex items-center mb-3">
                        <p class="font-body text-sm">
                            <i class="{{ $audit->state()->icon() }} text-lg text-{{ $audit->state()->color() }} leading-none mr-1/2 -ml-1/2"></i>
                            <span class="text-gray-600">{{ $audit->state()->action() }}</span>
                            <span class="text-gray-500">{{ $audit->state()->auditable() }}</span>
                        </p>
                        <p class="font-body text-xs text-gray-400 ml-2">@ {{ $audit->created_at }}</p>
                    </div>
                    <div class="flex items-center">
                        <p class="text-xs text-gray-400 mr-2">
                            <i class="uil uil-globe text-gray-300 text-sm leading-none mr-1/4"></i>
                            {{ $audit->ip_address }}
                        </p>
                        <p class="text-xs text-gray-400">
                            <i class="uil uil-window text-gray-300 text-sm leading-none mr-1/4"></i>
                            {{ $audit->user_agent }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-page-container>
@endsection
