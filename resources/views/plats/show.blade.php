<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail du plat') }}
        </h2>
    </x-slot>
    @php
        if($plat->image_menu == "")
            $image = "default_image.jpg"; //image par default
        else {
            $image = $plat->image_menu;
        }
    
    $date = Carbon\Carbon::parse($plat->date_menu);
    $formattedDate = $date->format("l j F Y");

    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto max-w-xl overflow-hidden rounded-lg bg-white shadow">
                <img src="{{ asset('images/' . $image) }}" alt="Image du plat" class="aspect-video w-full object-cover"/>
                
                <div class="p-4">
                    <p class="mb-1 text-sm text-primary-500"><time>{{$formattedDate}}</time></p>
                    <h3 class="text-xl font-medium text-gray-900">{{$plat->nom_menu}}</h3>
                    <p class="mt-1 text-gray-500">{{$plat->description_menu}}</p>
                    @php
                        $collection = explode(",",$plat->description_menu)
                    @endphp
                    <div class="mt-4 flex gap-2">
                    @foreach ($collection as $item)
                    <span class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-blue-600">
                        {{$item}}
                    </span>
                    @endforeach
                    </div>
                </div>
                <div class="p-4">
                    <a href="{{ route('plats.edit', $plat->id) }}" class="bg-blue-400 hover:bg-blue-800 rounded-lg p-2 hover:text-white mb-2 mr-2">Modifier</a>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
