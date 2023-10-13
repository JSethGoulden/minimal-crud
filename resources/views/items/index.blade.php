<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($items->isNotEmpty())
                        <ul>
                            @foreach($items as $item)
                            <li class=>
                                <a href="{{ route('items.show', $item)}}" class="cursor-pointer text-blue-700"> {{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        There are no items to display.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
