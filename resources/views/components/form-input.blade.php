<div class="{{ $class }}">
    @if(!empty($label))
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2" for="{{ $name }}">
            @if(!empty($icon))
                <i class="{{ $icon }}"></i>
            @endif
            {{ $label }}
        </label>
    @endif
    <input class="appearance-none block w-full bg-gray-50 text-gray-700 text-sm border border-gray-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white"
           type="{{ $type }}"
           placeholder="{{ $placeholder }}"
           id="{{ $name }}"
           name="{{ $name }}"
           autocomplete="{{ $autocomplete }}"
           value="{{ $value }}"/>
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
