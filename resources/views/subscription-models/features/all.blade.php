@extends("layouts.subscription-model")

@section("breadcrumbs")
    {{ Breadcrumbs::render('subscription-models.features.all', $subscription_model) }}
@endsection

@section("title")
    Features
@endsection

@section("action-button")
<a href="{{ route("subscription-models.features.create", [ "subscription_model" => $subscription_model]) }}" class="btn success">
    <i class="uil uil-plus mr-1/4"></i>
    New Feature
</a>
@endsection

@section("subscription-model-content")
    @if(!$features->count())
        <p class="font-body text-gray-400 text-center leading-none">
            <i class="uil uil-desert text-2xl leading-none mr-1/2"></i>
            You do not have any features for this subscription model. To create one, click on the New button.
        </p>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
        @foreach($features as $item)
            <div class="flex flex-col justify-between px-5 py-4 bg-white shadow-md rounded hover:shadow-xl fastest-transition">
                <div class="flex-grow-1 flex-shrink-0">
                    <p class="text-xs mb-3">
                        <i class="uil uil-clock leading-none text-orange-500 mr-1/2"></i><span class="text-gray-400">{{ humanize($item->created_at) }}</span>
                    </p>
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-display font-semibold text-gray-500 text-lg">{{ $item->name }}</h3>
                        <div class="flex items-center">
                            @if($item->is_infinite)
                                <i class="uil uil-unlock-alt mr-1 text-purple-600 text-lg leading-none"></i>
                            @else
                                <i class="uil uil-lock-alt mr-1 text-orange-500 text-lg leading-none"></i>
                            @endif
                            <span class="circle {{ $item->is_active ? "bg-green-500" : "bg-red-400" }}"></span>
                        </div>
                    </div>
                    <p class="font-body text-gray-400 text-sm">{{ $item->stripped_description }}</p>
                </div>
                <div class="w-full flex items-center justify-between mt-4">
                    <form action="{{ route("subscription-models.features.destroy", [ "subscription_model" => $subscription_model->id, "feature" => $item->id ]) }}"
                          method="post">
                        @csrf
                        @method("delete")
                        <delete-button></delete-button>
                    </form>
                    <a href="{{ route("subscription-models.features.edit", [ "subscription_model" => $subscription_model->id, "feature" => $item->id ]) }}"
                       class="text-sm text-gray-400 hover:text-blue-500 hover:no-underline fastest-transition">
                        <i class="uil uil-edit mr-1/2"></i>Edit
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
