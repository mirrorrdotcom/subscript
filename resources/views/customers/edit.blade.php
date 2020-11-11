@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('customers.edit', $customer) }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700 mb-4">Edit Customer</h1>
        <form action="{{ route("customers.update", [ "customer" => $customer ]) }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
            @csrf
            @method("put")
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: Customer Name"
                              label="Name"
                              value="{{ old('name') ?? $customer->name }}"></x-form-input>
            </div>
            <x-rtf-editor class="w-full"
                          name="description"
                          label="Description (Optional)"
                          value="{{ old('description') ?? $customer->description }}"
                          class="mb-4"></x-rtf-editor>
            <div class="mb-4">
                <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2">Balance: </label>
                <div class="relative {{ !empty($plan) && $customer->balance >= $plan->price ?  'text-green-700' : 'text-red-400'}} text-sm">
                    {{ number_format($customer->balance, 2) }}
                </div>
            </div>
            <div class="mb-4">
                <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2">Current Plan: </label>
                <div class="relative {{ !empty($plan) ?  'text-gray-700' : 'text-red-400'}} text-sm">
                    <a href="{{ route('customers.plans.edit', ['customer' => $customer->id]) }}">
                    @if (!empty($plan))
                         {{ $plan->name }} subscribed {{ humanize($plan->pivot->start_date) }}
                    @else
                        This customer is not subscribed to any plan
                    @endif
                    </a>
                </div>
            </div>
            <div class="flex justify-between">
                <x-form-checkbox name="is_active" label="Activate Customer" checked="{{ old('is_active') ?? $customer->is_active }}"></x-form-checkbox>
                <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
            </div>
        </form>
    </x-page-container>
@endsection
