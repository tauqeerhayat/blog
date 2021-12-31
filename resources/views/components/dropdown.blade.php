@props(['trigger'])
<div x-data="{ show: false }" @click.away="show = false">
    {{-- Trigger --}}
    <div @click="show = ! show">
        {{ $trigger }}
    </div>
    {{-- Links --}}
    <div x-show="show" class="py-2 absolute br-gray-100 mt-2 rounded-xl w-full z-50 bg-gray-100 overflow-auto max-h-52"
         style="display: none">
        {{ $slot }}
    </div>

</div>