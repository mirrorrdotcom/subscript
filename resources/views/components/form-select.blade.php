<div class="{{ $class }}">
    @if(!empty($label))
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2" for="{{ $name }}">
            @if(!empty($icon))
                <i class="{{ $icon }}"></i>
            @endif
            {{ $label }}
        </label>
    @endif
    <div class="relative">
        <select class="appearance-none block w-full bg-gray-50 text-gray-700 text-sm border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white"
                id="{{ $name }}"
                name="{{ $name }}"
                autocomplete="{{ $autocomplete }}">
            @if(!empty($placeholder))
                <option value="{{ $placeholder }}" {{ !$value ? "selected" : "" }} disabled>{{ $placeholder }}</option>
            @endif
            @foreach($options as $option)
                <option value="{{ $option["value"] }}" {{ $value == $option["value"] ? "selected" : "" }}>
                    {{ $option["label"] }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            <svg class="fill-current h-4 w-4"
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
            </svg>
        </div>
    </div>
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
