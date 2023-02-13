<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Menu Restau YC</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
    <div class="bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-gray-700 via-gray-900 to-black" id="top">
        {{-- navbar --}}
        <div class="relative flex items-top justify-center min-h-screen  dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-100">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-100">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-100">Register</a>
                        @endif
                    @endauth

                </div>
            @endif 
            <div class="flex flex-col md:flex-row mx-20">
                <div class="md:w-7/12 flex items-center text-white">
                    <div>
                        <h1 class="title-land">Bienvenue au Restaurant YouCode</h1>
                        <p class="mb-5">Lorem ipsum dolor sit amet. Et maxime ullam aut dolorem atque ut sequi cumque est laborum atque!</p>
                        <a href="#plats" class="text-sm text-gray-100 hover:text-gray-900 border hover:bg-gray-300 bg-transparent p-3 px-4 rounded-xl mt-5">Decouvrir</a>

                        {{-- @if (Route::has('login'))
                            <div class="my-5">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-100 hover:text-gray-900 border hover:bg-gray-300 bg-transparent p-3 px-4 rounded-xl">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-100 hover:text-gray-900 border hover:bg-gray-300 bg-transparent p-3 px-4 rounded-xl mr-2">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-sm text-gray-100 hover:text-gray-900 border hover:bg-gray-300 bg-transparent p-3 px-4 rounded-xl">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif  --}}
                    </div>
                </div>
                <img src="{{ asset('images/img-landing-page.png') }}" class="img-landing w-full md:w-4/12" alt="">
            </div>  
        </div>
        <div>
            <section class="min-h-screen body-font text-gray-600">
                <h2 class="text-center text-gray-200" id="plats">LES PLATS</h2>
                <div class="container mx-auto px-5 py-10">
                    <div class="-m-4 flex flex-wrap">
                    @foreach ($plats as $plat)
                        @php
                        if($plat->image_menu == "")
                            $image = "default_image.jpg"; //image par default
                        else {
                            $image = $plat->image_menu;
                        }
                        
                        $date = Carbon\Carbon::parse($plat->date_menu);
                        $formattedDate = $date->format("l j F Y");
                        @endphp
                    
                        <div class="w-full p-4 md:w-1/2 lg:w-1/4 plat-card">
                            <a class="relative block h-48 overflow-hidden rounded">
                                <img src="{{ asset('images/' . $image) }}" alt="Image du plat" class="aspect-video w-full object-cover image-plat"/>
                            </a>
                            <div class="pt-4 bg-gradient-to-b from-gray-800 via-gray-900 to-transparent rounded-b-xl p-3">
                                <h3 class="title-font mb-1 text-xs tracking-widest text-gray-400">{{$plat->nom_menu}}</h3>
                                {{-- <p class="title-font text-gray-100 text-sm my-2 font-small text-gray-300 desc-text">{{$plat->description_menu}}</p> --}}
                                <div class="my-3">
                                    @php
                                        $collection = explode(",",$plat->description_menu)
                                    @endphp
                                    @foreach ($collection as $item)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                        {{$item}}
                                    </span>
                                    @endforeach
                                </div>
                                <small class="mt-1">{{$formattedDate}}</small>
                                <br>
                                @auth
                                    <a href="{{ route('plats.edit', $plat->id) }}" class="text-gray-100 hover:text-gray-300 mb-2 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" class="w-5 h-5 my-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                          
                                    </a>
                                @endauth
                            </div>
                        </div>
                        
                    @endforeach
                    </div>
                </div>
                <div class="container mx-auto px-5 py-5">
                    <div class="pagination">
                        {{ $plats->links() }}
                    </div>
                </div>
            </section>
            <footer class="text-center text-white text-xl p-3">
                <a href="#top">
                    <small>Back to top</small>
                </a>
            </footer>
        </div>
    </div>
    </body>
</html>
