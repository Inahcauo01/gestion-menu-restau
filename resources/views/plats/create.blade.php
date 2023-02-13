<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un plat
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('plats.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="date_menu" class="block font-medium text-sm text-gray-700">Date</label>
                            <input type="date" name="date_menu" id="date_menu" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('date_menu', '') }}" />
                            @error('date_menu')
                                <small class="text-sm text-red-600">{{ $message }}</small>
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
                            class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                            @error('image_menu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>