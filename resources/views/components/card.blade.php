<div class="shadow p-4 bg-white mt-4 rounded">
    <div class="text-left">
        <h3 class="mb-2 text-gray-900 text-lg">{{ $title }}</h3>
        {{ $body }}
    </div>
    @if (isset($buttons))
        <div class="flex items-center justify-end mt-4"">
            {{ $buttons }}
        </div>
    @endif
</div>
