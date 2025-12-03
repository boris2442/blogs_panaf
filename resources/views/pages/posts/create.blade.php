@extends('layouts.layout')

@section('content')
    <div class="container mx-auto max-w-3xl p-4">

        <h1 class="mb-6 text-2xl font-bold text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
            Créer un nouvel article
        </h1>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Titre -->
            <div class="mb-4">
                <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
                    Titre *
                </label>

                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border px-3 py-2 focus:border-[var(--primary-blue)] focus:ring" required>
                @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>



            <!-- Contenu -->
            <div class="mb-4">
                <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
                    Contenu *
                </label>

                <textarea name="content" rows="6"
                    class="w-full rounded-lg border px-3 py-2 focus:border-[var(--primary-blue)] focus:ring"
                    required>{{ old('content') }}</textarea>

                @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <!-- Image Upload -->
            <div class="mb-4">
                <label class="mb-1 block font-medium text-[var(--primary-blue)] dark:text-[var(--dark-gold)]">
                    Image du post *
                </label>

                <div id="dropZone"
                    class="mt-1 flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed hover:border-[var(--primary-blue)] dark:hover:border-[var(--dark-gold)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-2 h-8 w-8 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0l-4 4m4-4l4 4" />
                    </svg>

                    <p class="text-sm text-gray-500">
                        <span class="text-purple-600">Cliquez pour uploader</span> ou glissez-déposez<br />
                        PNG, JPG, WEBP (max. 2MB)
                    </p>

                    <input id="fileInput" type="file" name="thumbnail" accept="image/*" class="hidden">
                </div>

                <!-- Aperçu -->
                <div id="imagePreviewContainer" class="relative mt-3 w-max hidden">
                    <img id="imagePreview" class="h-24 w-24 rounded border object-cover">
                    <button type="button" id="removeImage"
                        class="absolute -top-2 -right-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 font-bold text-white hover:bg-red-600">
                        ×
                    </button>
                </div>

                @error('thumbnail')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>




            <!-- Submit -->
            <button type="submit"
                class="rounded-lg bg-blue-400 px-5 py-2 font-semibold text-white hover:bg-blue-700 dark:bg-[var(--dark-gold)] dark:hover:bg-yellow-600">
                Publier
            </button>

        </form>
    </div>

    <!-- Script preview image -->
    <script>
        const fileInput = document.getElementById('fileInput');
        const dropZone = document.getElementById('dropZone');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const preview = document.getElementById('imagePreview');
        const removeBtn = document.getElementById('removeImage');

        // Click zone
        dropZone.addEventListener('click', () => fileInput.click());

        // Drag & Drop
        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.classList.add('border-blue-600');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-600');
        });

        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-600');
            fileInput.files = e.dataTransfer.files;
            showPreview();
        });

        // File input change
        fileInput.addEventListener('change', showPreview);

        function showPreview() {
            const file = fileInput.files[0];
            if (!file) return;

            const url = URL.createObjectURL(file);
            preview.src = url;
            previewContainer.classList.remove('hidden');
        }

        removeBtn.addEventListener('click', () => {
            fileInput.value = '';
            previewContainer.classList.add('hidden');
        });
    </script>

@endsection