<div class="{{ $class }}">
    @if(!empty($label))
        <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-1/2" for="{{ $name }}">
            @if(!empty($icon))
                <i class="{{ $icon }}"></i>
            @endif
            {{ $label }}
        </label>
    @endif
    <textarea class="__editor"
              placeholder="{{ $placeholder }}"
              id="{{ $name }}"
              name="{{ $name }}"
              autocomplete="{{ $autocomplete }}">@if($value){{ $value }}@endif</textarea>
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
