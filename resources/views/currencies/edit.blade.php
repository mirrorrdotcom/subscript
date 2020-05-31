@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('currencies.edit', $currency) }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700 mb-4">Edit Currency</h1>
        <form action="{{ route("currencies.update", [ "currency" => $currency ]) }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
            @csrf
            @method("put")
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: Lebanese Pounds"
                              label="Name"
                              value="{{ old('name') ?? $currency->name }}"></x-form-input>
                <x-form-input type="number"
                              name="rate"
                              placeholder="e.g: 1500"
                              label="Rate (1 USD Equivalent)"
                              step="0.00000001"
                              value="{{ old('rate') ?? $currency->rate }}"></x-form-input>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="code"
                              placeholder="e.g: lbp"
                              label="Code"
                              value="{{ old('code') ?? $currency->code }}"></x-form-input>
                <x-form-input type="text"
                              name="symbol"
                              placeholder="e.g: LBP"
                              label="Symbol (Optional)"
                              value="{{ old('symbol') ?? $currency->symbol }}"></x-form-input>
            </div>
            <div class="flex justify-between">
                <x-form-checkbox name="is_active" label="Activate Currency" checked="{{ old('is_active') ?? $currency->is_active }}"></x-form-checkbox>
                <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
            </div>
        </form>
    </x-page-container>
@endsection
