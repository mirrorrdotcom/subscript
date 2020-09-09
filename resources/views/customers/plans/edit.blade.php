@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('customers.plans.edit', $customer) }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700 mb-4">Edit Customer's Plan</h1>
        <form action="{{ route("customers.plans.update", [ "customer" => $customer]) }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
            @csrf
            @method("put")
            @if(empty($plan))
            <div class="mb-4">
                <div class="relative text-red-400 text-sm">
                    This customer is not subscribed to any plan
                </div>
            </div>
            @endif
            <x-form-select name="plan_id"
                           label="Change Plan"
                           value="{{ old('plan') ?? $plan->id ?? null}}"
                           class="mb-4"
                           :options="$plans"></x-form-select>
            <div class="flex justify-between">
                <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
            </div>
        </form>
    </x-page-container>
@endsection
