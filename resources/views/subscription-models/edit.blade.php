@extends("layouts.subscription-model")

@section("title")
    Edit Subscription Model
@endsection

@section("subscription-model-content")
    <form action="{{ route("subscription-models.update", [ "subscription_model" => $subscription_model->id ]) }}"
          method="post"
          class="py-4 px-5 bg-white rounded shadow-md">
        @csrf
        @method("put")
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <x-form-input type="text"
                          name="slug"
                          placeholder="e.g: the-subscription-model"
                          label="Slug"
                          value="{{ old('slug') ?? $subscription_model->slug }}"></x-form-input>
            <x-form-input type="text"
                          name="name"
                          placeholder="e.g: The Subscription Model"
                          label="Name"
                          value="{{ old('name') ?? $subscription_model->name }}"></x-form-input>
        </div>
        <x-rtf-editor class="w-full"
                      name="description"
                      label="Description (Optional)"
                      value="{{ old('description') ?? $subscription_model->description }}"
                      class="mb-4"></x-rtf-editor>
        <div class="flex justify-between">
            <x-form-checkbox name="is_active" label="Activate Subscription Model" checked="{{ old('is_active') ?? $subscription_model->is_active }}"></x-form-checkbox>
            <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
        </div>
    </form>
@endsection
