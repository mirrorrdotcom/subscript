@extends("layouts.consumer")

@section("breadcrumbs")
    {{ Breadcrumbs::render('consumers.permissions.edit', $consumer) }}
@endsection

@section("title")
    Edit Consumer's Permissions
@endsection

@section("consumer-content")
    <form action="{{ route("consumers.permissions.update", [ "consumer" => $consumer ]) }}" method="post" class="py-4 px-5 bg-white rounded shadow-md">
        @csrf
        @method("put")
        <div class="pb-4 mb-2">
            <h2 class="font-display text-sm text-gray-400 leading-none uppercase mb-2">Permissions</h2>
            <p class="font-body text-sm text-orange-400 leading-none mb-4">
                <i class="uil uil-info-circle"></i>
                Select the permissions you wish to give this consumer.
            </p>
            @if(!count($permissions))
                <p class="py-4 font-body text-gray-400 text-center leading-none">
                    <i class="uil uil-desert text-2xl leading-none mr-1/2"></i>
                    There are no permissions available at the moment.
                </p>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($permissions as $id => $name)
                        <x-form-checkbox name="permissions[]"
                                         label="{{ $name }}"
                                         value="{{ $id }}"
                                         checked="{{ in_array($id, $currentPermissions) }}"></x-form-checkbox>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="flex justify-between">
            <button class="btn success"><i class="uil uil-save mr-1/2"></i>Save</button>
        </div>
    </form>
@endsection
