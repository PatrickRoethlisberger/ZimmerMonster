@props(['action','model'])

<x-card>
    <x-slot name="body">
        <div class="flex items-center justify-start">
            <h3 class="text-xl pr-6">
                {{ $model->name }}
            </h3>
            <a class="flex items-center justify-end" href="{{(route('manage.hotel.edit', ['hotel' => $model->hotel]))}}">
                <p class="text-gray-400 pr-1">
                    {{ $model->hotel->name }}
                </p>
                <x-stars stars="{{ $model->hotel->stars }}" />
            </a>
        </div>
        <div class="absolute top-4 right-4 py-2 px-4 bg-blue-200 rounded-lg">
            <span class="text-md">{{ number_format($model->price, 2) }} CHF</span>
        </div>
        <div class="mt-4">
            {!! $model->description !!}
        </div>

    </x-slot>
    <x-slot name="buttons">
        <div class="flex items-center justify-between w-full">
            <div class='my-3 flex flex-wrap -m-1'>
                @foreach ( $model->equipments as $equipment )
                    <span class="m-1 bg-gray-200 hover:bg-gray-300 rounded-full px-2 font-bold text-sm leading-loose">{{ $equipment->name }}</span>
                @endforeach
            </div>
            <div>
                @if (isset($buttons))
                    {{ $buttons }}
                @endif
            </div>
        </div>
    </x-slot>
</x-card>
