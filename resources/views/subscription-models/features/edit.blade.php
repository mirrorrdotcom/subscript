@extends("layouts.subscription-model")

@section("title")
    Edit Feature
@endsection

@section("subscription-model-content")
    <form action="{{ route("subscription-models.features.update", [ "subscription_model" => $subscription_model, "feature" => $feature ]) }}"
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
                              value="{{ old('slug') ?? $feature->slug }}"></x-form-input>
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: Basic"
                              label="Name"
                              value="{{ old('name') ?? $feature->name }}"></x-form-input>
            </div>
            <x-rtf-editor class="w-full"
                          name="description"
                          label="Description (Optional)"
                          value="{{ old('description') ?? $feature->description }}"
                          class="mb-4"></x-rtf-editor>
            <x-form-checkbox name="is_active" label="Activate Feature" checked="{{ old('is_active') ?? $feature->is_active }}"></x-form-checkbox>
        </div>
        <div class="pb-4 mb-2">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-2">Usage Limit</h2>
            <p class="font-body text-sm text-orange-400 leading-none mb-4">
                <i class="uil uil-info-circle"></i>
                Leave empty if the feature does not limit the usage (infinite).
            </p>
            <x-form-input type="number"
                          name="limit"
                          placeholder="e.g: 1"
                          label="Limit"
                          value="{{ old('limit') ?? $feature->limit }}"></x-form-input>
        </div>
        <div class="flex justify-end">
            <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
        </div>
    </form>
@endsection
