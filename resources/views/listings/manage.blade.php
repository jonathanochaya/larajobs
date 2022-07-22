<x-layout>
    <x-card class="p-10 rounded">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Jobs</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @if(!$listings->isEmpty())
                    @foreach($listings as $listing)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ @route('listing', $listing->id) }}">{{ $listing->title }}</a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ @route('edit', $listing->id) }}" class="text-blue-400 px-6 py-2 rounded-xl">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form action="{{ @route('delete', $listing->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No Jobs Created Yet</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </x-card>
</x-layout>
