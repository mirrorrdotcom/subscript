@extends("layouts.app")

@section("breadcrumbs")
    {{ Breadcrumbs::render('consumers.edit', $consumer) }}
@endsection

@section("content")
    <x-page-container class="py-5">
        <h1 class="font-display font-bold text-2xl text-gray-700 mb-4">Edit Consumer</h1>
        <form action="{{ route("consumers.update", [ "consumer" => $consumer ]) }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
            @csrf
            @method("put")
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-form-input type="text"
                              name="name"
                              placeholder="e.g: Consumer Name"
                              label="Name"
                              value="{{ old('name') ?? $consumer->name }}"></x-form-input>
            </div>
            <x-rtf-editor class="w-full"
                          name="description"
                          label="Description (Optional)"
                          value="{{ old('description') ?? $consumer->description }}"
                          class="mb-4"></x-rtf-editor>
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div class="grid-cols-2">
                    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2" for="api_token">
                        API Token
                    </label>
                    <generate-token value="{{ old('api_token') ?? $consumer->api_token }}"></generate-token>
                </div>
            </div>
            <div class="flex justify-between">
                <x-form-checkbox name="is_active" label="Activate Consumer" checked="{{ old('is_active') ?? $consumer->is_active }}"></x-form-checkbox>
                <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
            </div>
        </form>
    </x-page-container>
@endsection
