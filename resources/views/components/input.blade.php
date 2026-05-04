
<div class="space-y-1.5">
    @if(isset($label))
        <label class="block text-sm font-semibold text-gray-700">
            {{ $label }} @if(isset($required))<span class="text-red-500">*</span>@endif
        </label>
    @endif
    {{ $slot }}
    @if(isset($helper))
        <p class="text-gray-400 text-xs">{{ $helper }}</p>
    @endif
</div>

