<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Podcast Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">{{ $podcast->title }}</h2>
                    <p class="mb-4">{{ $podcast->description }}</p>

                    @if ($podcast->image)
                        <img src="{{ asset('storage/images/' . $podcast->image) }}" alt="Podcast Image" class="mb-4">
                    @endif

                    @if ($podcast->video)
                        <video controls width="100%" height="auto">
                            <source src="{{ asset('storage/videos/' . $podcast->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    <p class="mt-4">
                        <strong>Reference ID:</strong> {{ $podcast->reference_id }}
                    </p>

                    <a href="{{ route('podcasts.edit', $podcast) }}" style="background-color: #4a90e2 !important;" class="inline-block hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out">Edit</a>

                    <form action="{{ route('podcasts.destroy', $podcast) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
