<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('items.update', $item)}}" method="post">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" value="Name"> </x-input-label>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $item->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description"> </x-input-label>
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $item->description)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <x-primary-button class="my-2">{{ __('Save') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
