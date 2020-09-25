@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render("transactions.all") }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <div class="flex items-center justify-between ">
            <h1 class="font-display font-bold text-2xl text-gray-700">Transactions</h1>
        </div>
        <div>
            @foreach($transactions as $transaction)
                <div class="pt-4 pb-2 border-b border-gray-200 fastest-transition">
                    <div class="flex items-center mb-3">
                        <p class="font-body text-sm">
                            @php
                                $deposited =  $transaction->balance_after > $transaction->balance_before;
                            @endphp
                            <i class="uil {{ $deposited ? "uil-plus-circle" : "uil-minus-circle" }} text-lg text-{{ $deposited ? "green-500" : "red-500"}} leading-none mr-1/2 -ml-1/2"></i>
                            <span class="text-gray-600">{{ $transaction->action }}</span>
                        </p>
                        <p class="font-body text-xs text-gray-400 ml-2">@ {{ $transaction->created_at }}</p>
                    </div>
                    <div class="flex items-center">
                        <p class="text-sm text-gray-400 hover:text-blue-400 mb-2">
                            <i class="uil uil-user"></i>
                            <a href="{{ route("customers.edit", [ "customer" => $transaction->customer->id ]) }}"> {{ $transaction->customer->name }} </a>
                        </p>
                    </div>
                    <div class="flex items-center">
                        <p class="text-xs text-gray-400 mr-2">
                            Old Balance: {{ number_format($transaction->balance_before, 2) }}
                        </p>
                        <p class="text-xs text-gray-400 mr-2">
                            New Balance: {{ number_format($transaction->balance_after, 2) }}
                        </p>
                        <p class="text-xs text-gray-400 mr-2">
                            Amount: {{ number_format($transaction->amount, 2) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-page-container>
@endsection
