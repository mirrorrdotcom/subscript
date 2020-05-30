<label class="inline-flex items-center {{ $class }}">
    <input class="mr-1" type="checkbox" name="{{ $name }}" {{ $checked ? "checked" : "" }} value="{{ $value }}">
    <span class="text-sm text-gray-600">@if(!empty($icon))<i class="mr-1 {{ $icon }}"></i>@endif{{ $label }}</span>
</label>
@error($name)
<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
