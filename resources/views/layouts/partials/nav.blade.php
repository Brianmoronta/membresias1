<nav class="bg-green-900 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <div class="font-bold">🌲 Club Vista a las Montañas</div>
        <ul class="flex space-x-4">
            @foreach(\App\Models\Menu::where('visible', true)->orderBy('orden')->get() as $item)
                <li><a href="{{ url($item->url) }}" class="hover:underline">{{ $item->nombre }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
