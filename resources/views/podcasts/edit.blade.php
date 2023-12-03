<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('podcasts.update', $podcast) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Use PATCH method for updates -->

            <div>
                <label for="reference_id">Reference ID:</label>
                <input
                    type="text"
                    name="reference_id"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="reference_id"
                    value="{{ old('reference_id', $podcast->reference_id) }}">
            </div>

            <div>
                <label for="title">Title:</label> <!-- Corrected the label name -->
                <input
                    type="text"
                    name="title"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="title"
                    value="{{ old('title', $podcast->title) }}">
            </div>

            <div>
                <label for="title">Descrição:</label> <!-- Corrected the label name -->
                <input
                    type="text"
                    name="description"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="description"
                    value="{{ old('description', $podcast->description) }}">
            </div>

            <div>
                <label for="image">Imagem:</label>
                <input
                    type="text"
                    name="image_url"
                    placeholder="URL da Imagem"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="image"
                    value="{{ old('image_url', $podcast->image) }}">
            </div>

            <div>
                <label for="video">Vídeo:</label>
                <input
                    type="text"
                    name="video_url"
                    placeholder="URL do Vídeo"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="video"
                    value="{{ old('video_url', $podcast->video) }}">
            </div>

            <div>
                <label for="image_file">Upload de Imagem:</label>
                <input
                    type="file"
                    name="image_file"
                    accept="image/*"
                    class="block"
                    id="image_file">
            </div>

            <div>
                <label for="video_file">Upload de Vídeo:</label>
                <input
                    type="file"
                    name="video_file"
                    accept="video/*"
                    class="block"
                    id="video_file">
            </div>


            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Update') }}</x-primary-button>
                <a href="{{ route('podcasts.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


