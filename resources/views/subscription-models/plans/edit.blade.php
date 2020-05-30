@extends("layouts.subscription-model")

@section("title")
    Create New Plan
@endsection

@section("subscription-model-content")
    <form action="{{ route("subscription-models.plans.update", [ "subscription_model" => $subscription_model->id, "plan" => $plan->id ]) }}"
          method="post"
          class="py-4 px-5 bg-white rounded shadow-md">
        @csrf
        @method("put")
        <div class="pb-4 mb-4 border-b border-gray-200">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-3">General Info</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="slug"
                              placeholder="e.g: basic"
                              label="Slug"
                              value="{{ old('slug') ?? $plan->slug }}"></x-form-input>
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: Basic"
                              label="Name"
                              value="{{ old('name') ?? $plan->name }}"></x-form-input>
            </div>
            <x-rtf-editor class="w-full"
                          name="description"
                          label="Description (Optional)"
                          value="{{ old('description') ?? $plan->description }}"
                          class="mb-4"></x-rtf-editor>
            <x-form-checkbox name="is_active" label="Activate Plan" checked="{{ old('is_active') ?? $plan->is_active }}"></x-form-checkbox>
        </div>
        <div class="pb-4 mb-2">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-3">Trial</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input type="number"
                              name="trial_period"
                              placeholder="e.g: 1"
                              label="Trial Period"
                              value="{{ old('trial_period') ?? $plan->trial_period }}"></x-form-input>
                <x-form-select type="text"
                              name="trial_interval"
                              label="Trial Interval"
                              :options="$intervals"
                              value="{{ old('trial_interval') ?? $plan->trial_interval }}"></x-form-select>
            </div>
        </div>
        <div class="pb-4 mb-2">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-3">Recurring</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input type="number"
                              name="recurring_period"
                              placeholder="e.g: 1"
                              label="Recurring Period"
                              value="{{ old('recurring_period') ?? $plan->recurring_period }}"></x-form-input>
                <x-form-select type="text"
                               name="recurring_interval"
                               label="Recurring Interval"
                               :options="$intervals"
                               value="{{ old('recurring_interval') ?? $plan->recurring_interval }}"></x-form-select>
            </div>
        </div>
        <div class="pb-4 mb-2">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-3">Grace</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input type="number"
                              name="grace_period"
                              placeholder="e.g: 1"
                              label="Grace Period"
                              value="{{ old('grace_period') ?? $plan->grace_period }}"></x-form-input>
                <x-form-select type="text"
                               name="grace_interval"
                               label="Grace Interval"
                               :options="$intervals"
                               value="{{ old('grace_interval') ?? $plan->grace_interval }}"></x-form-select>
            </div>
        </div>
        <div class="flex justify-end">
            <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
        </div>
    </form>
@endsection