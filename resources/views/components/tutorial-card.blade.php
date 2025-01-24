@props(['title', 'description', 'id', 'icon', 'type'])

<a href="{{route('guide.view_guide',['id' => $id])}}" class="tutorial-card w-64 bg-white rounded-xl border border-gray-300 p-9 relative overflow-hidden cursor-pointer transition-shadow hover:shadow-2xl"> 
    <div class="w-24 h-24 bg-gray-800 rounded-full absolute -right-8 -top-7">
        <p class="absolute bottom-6 left-7 text-white text-2xl">{{ $id }}</p>
    </div>
    <div class="w-12 flex justify-center text-4xl -mt-1 mb-5">
        {!! $icon !!}
    </div>
    <h1 class="tutorial-card-title font-bold text-xl">{{ $title }}</h1>
    <p class="text-sm text-zinc-500 leading-6">
        {{ $description }}
    </p>
    <div class="{{ $type ? 'bg-green-600' : 'bg-blue-800' }} rounded-full absolute bottom-3 right-3">
        <p class="text-white text-center p-1 text-xs text-nowrap">{{ $type ? 'Guia rápida' : 'Guia completa' }}</p>
    </div>
</a>
