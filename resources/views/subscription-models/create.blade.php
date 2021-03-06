@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('subscription-models.create') }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700 mb-4">New Subscription Model</h1>
        <form action="{{ route("subscription-models.store") }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="slug"
                              placeholder="e.g: the-subscription-model"
                              label="Slug"
                              value="{{ old('slug') }}"></x-form-input>
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: The Subscription Model"
                              label="Name"
                              value="{{ old('name') }}"></x-form-input>
            </div>
            <x-rtf-editor class="w-full"
                          name="description"
                          label="Description (Optional)"
                          value="{{ old('description') }}"
                          class="mb-4"></x-rtf-editor>
            <div class="flex justify-between">
                <x-form-checkbox name="is_active" label="Activate Subscription Model" checked="{{ old('is_active') ?? true }}"></x-form-checkbox>
                <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
            </div>
        </form>
    </x-page-container>
@endsection
