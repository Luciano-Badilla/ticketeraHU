@props(['title', 'description', 'id', 'icon'])

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
</a>
