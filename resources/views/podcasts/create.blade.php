<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('podcasts.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="reference_id">Reference ID:</label>
                <input
                    type="text"
                    name="reference_id"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="reference_id"
                    value="{{ old('reference_id') }}">
            </div>

            <div>
                <label for="title">Title:</label>
                <input
                    type="text"
                    name="title"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="title"
                    value="{{ old('title') }}">
            </div>

            <div>
                <label for="description">Descrição:</label>
                <input
                    type="text"
                    name="description"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="description"
                    value="{{ old('description') }}">
            </div>

            <div>
                <label for="image">Imagem (URL ou Upload):</label>
                <div class="flex items-center">
                    <input
                        type="text"
                        name="image_url"
                        placeholder="Insira o URL da imagem"
                        class="flex-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        id="image_url"
                        value="{{ old('image_url') }}">
                    <span class="ml-2">ou</span>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="ml-2"
                        id="image">
                </div>
            </div>

            <div>
                <label for="video">Vídeo (URL ou Upload):</label>
                <div class="flex items-center">
                    <input
                        type="text"
                        name="video_url"
                        placeholder="Insira o URL do vídeo"
                        class="flex-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        id="video_url"
                        value="{{ old('video_url') }}">
                    <span class="ml-2">ou</span>
                    <input
                        type="file"
                        name="video"
                        accept="video/*"
                        class="ml-2"
                        id="video">
                </div>
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('podcasts.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
