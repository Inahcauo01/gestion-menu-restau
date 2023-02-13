<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des plats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="block">
                <a href="{{ route('plats.create') }}" class="bg-cyan-500 hover:bg-cyan-600 p-2 rounded text-white">Ajouter un plat</a>
            </div> --}}
            <!-- Modal toggle -->
            <button onclick="viderform()" id="add-plat" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-cyan-500 hover:bg-cyan-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Ajouter un plat
            </button>

            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-slate-100">
                        <tr>
                            {{-- <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th> --}}
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Image</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nom</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Description</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        
                    @foreach ($plats as $plat)
                    @php
                        if($plat->image_menu == "")
                            $image = "default_image.jpg"; //image par default
                        else {
                            $image = $plat->image_menu;
                        }
                    @endphp

                        <tr class="hover:bg-gray-50">
                            {{-- <td><div class="font-medium text-gray-500 pl-6">{{$plat->id}}</div></td> --}}
                            <td class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10">
                                    <img
                                        class="h-full w-full rounded-lg object-cover object-center"
                                        src="{{ asset('images/' . $image) }}" alt="Image du plat"
                                    />
                                </div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-700">{{$plat->nom_menu}}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                    {{$plat->description_menu}}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{$plat->date_menu}}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('plats.show', $plat->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a>
                                    <a href="{{ route('plats.edit', $plat->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
                                    <form class="inline-block" action="{{ route('plats.destroy', $plat->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @method('DELETE')
                                        @csrf
                                        {{-- <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                        <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination m-3">
                    {{ $plats->links() }}
                </div>
            </div>
        </div>
    </div>
    

  
  <!-- Main modal -->
  <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
      <div class="relative w-full h-full max-w-2xl md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Terms of Service
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
                <form method="post" action="{{ route('plats.store') }}" enctype="multipart/form-data" id="form-plat">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="date_menu" class="block font-medium text-sm text-gray-700">Date</label>
                            <input type="date" name="date_menu" id="date_menu" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('date_menu', '') }}" />
                            @error('date_menu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom_menu" class="block font-medium text-sm text-gray-700">Nom</label>
                            <input type="text" name="nom_menu" id="nom_menu" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nom_menu', '') }}" />
                            @error('nom_menu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description_menu" class="block font-medium text-sm text-gray-700">Description</label>
                            <textarea name="description_menu" id="description_menu" class="form-input rounded-md shadow-sm mt-1 block w-full" cols="30" rows="6" value="{{ old('description_menu', '') }}"></textarea>
                            @error('description_menu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="image_menu" class="block font-medium text-sm text-gray-700">Image</label>
                            <input type="file" name="image_menu" id="image_menu" accept=".png, .jpg, .jpeg, .webp, .svg"
                            class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-Indigo-500 file:text-Indigo-700 hover:file:bg-Indigo-100"/>
                            @error('image_menu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-cyan-500 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-cyan-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Ajouter
                    </button>
                    <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </form>
          </div>
      </div>
  </div>
  
    
</x-app-layout>
