@extends("layouts.subscription-model")

@section("breadcrumbs")
    {{ Breadcrumbs::render('subscription-models.plans.all', $subscription_model) }}
@endsection

@section("title")
    Plans
@endsection

@section("action-button")
<a href="{{ route("subscription-models.plans.create", [ "subscription_model" => $subscription_model]) }}" class="btn success">
    <i class="uil uil-plus mr-1/4"></i>
    New Plan
</a>
@endsection

@section("subscription-model-content")
    @if(!$plans->count())
        <p class="font-body text-gray-400 text-center leading-none">
            <i class="uil uil-desert text-2xl leading-none mr-1/2"></i>
            You do not have any plans for this subscription model. To create one, click on the New button.
        </p>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-4">
        @foreach($plans as $item)
            <div class="flex flex-col justify-between px-5 py-4 bg-white shadow-md rounded hover:shadow-xl fastest-transition">
                <div class="flex-grow-1 flex-shrink-0">
                    <p class="text-xs mb-3">
                        <i class="uil uil-clock leading-none text-orange-500 mr-1/2"></i><span class="text-gray-400">{{ humanize($item->created_at) }}</span>
                    </p>
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-display font-semibold text-gray-500 text-lg">{{ $item->name }}</h3>
                        <div class="flex items-center">
                            @if($item->is_free)
                                <p class="text-sm text-blue-300 leading-none uppercase mr-3">Free</p>
                            @else
                                <p class="text-sm text-purple-500 leading-none mr-3">USD {{ $item->price }}</p>
                            @endif
                            <span class="circle {{ $item->is_active ? "bg-green-500" : "bg-red-400" }}"></span>
                        </div>
                    </div>
                    <p class="font-body text-gray-400 text-sm">{{ $item->stripped_description }}</p>
                </div>
                <div class="w-full flex items-center justify-between mt-4">
                    <form action="{{ route("subscription-models.plans.destroy", [ "subscription_model" => $subscription_model->id, "plan" => $item->id ]) }}"
                          method="post">
                        @csrf
                        @method("delete")
                        <delete-button></delete-button>
                    </form>
                    <a href="{{ route("subscription-models.plans.edit", [ "subscription_model" => $subscription_model->id, "plan" => $item->id ]) }}"
                       class="text-sm text-gray-400 hover:text-blue-500 hover:no-underline fastest-transition">
                        <i class="uil uil-edit mr-1/2"></i>Edit
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
