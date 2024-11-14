@props(['error'])

<div class="bg-red-100 text-red-700 px-4 py-3 rounded-t relative">
    <ul class="mt-2 list-disc list-inside">
        @foreach ($error->all() as $error_message)
            <li>{{ $error_message }}</li>
        @endforeach
    </ul>
</div>
