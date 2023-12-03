<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Podcasts List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Podcasts List</h2>
                <ul>
                    @foreach ($podcasts as $podcast)
                        <li class="mb-4">
                            <p><strong>Título do podcast:</strong> {{ $podcast->title }}</p>
                            <p><strong>Resumo:</strong> {{ $podcast->description }}</p>
                            <p><strong>Imagem associada:</strong></p>
                            @if($podcast->image)
                            <p><img src="{{ asset('storage/images/'.basename($podcast->image)) }}" width="320" alt="Podcast Image"></p>
                            @else
                                <p>Sem imagem associada</p>
                            @endif

                            <p><strong>Video associado:</strong></p>
                            @if ($podcast->video)
                            <video width="320" height="240" controls>
                                <source src="{{ asset('storage/videos/'.basename($podcast->video)) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @else
                                <p>Sem video associado</p>
                            @endif
<!-- BOTÕES EDIT e DELETE -->
                            <div class="mt-2 space-x-2">
                                <a href="{{ route('podcasts.edit', $podcast) }}" style="background-color: #4a90e2 !important;" class="inline-block hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out">Edit</a>


                                <form action="{{ route('podcasts.destroy', $podcast) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>


