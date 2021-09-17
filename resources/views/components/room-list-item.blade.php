@props(['action','model'])

<div class="flex items-center space-x-4">

  <div class="flex-1">
    <span>{{ $model->name }}</span>
  </div>

  <div class="flex-1 text-right lg:text-left">
      {{ $model->price }}
  </div>

  <div class="flex-1 hidden lg:inline">
    <i>Rest of my custom content here...</i>
    <span class="flex text-xs text-gray-400">
    </span>
  </div>
  <x-lv-actions :actions="$actions" :model="$model" />
</div>
