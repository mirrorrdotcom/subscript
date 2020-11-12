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
            <div class="mb-4">
                <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2">Current Plan Details: </label>
                <div class="relative {{ !empty($plan) ?  'text-gray-700' : 'text-red-400'}} text-sm">
                    @if (!empty($plan))
                        <strong>{{ $plan->name }} plan</strong> subscribed {{ humanize($plan->pivot->start_date) }} and ends <span class="text-red-400">{{ humanize($plan->pivot->end_date) }} </span>
                    @else
                        This customer has no active subscription
                    @endif
                </div>
            </div>
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
