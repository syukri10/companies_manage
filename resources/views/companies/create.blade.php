<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-primary-button class="mb-4" onclick="window.location='{{ route('companies.index') }}'">
                        {{ __('Back to Companies') }}
                    </x-primary-button>
                        <h3 class="mb-4"> Create New Company</h3>

                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="website" :value="__('Website')" />
                            <x-text-input id="website" class="block mt-1 w-full" type="text" name="website"
                                :value="old('website')" />
                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="logo" :value="__('Company Logo')" />
                            <input id="logo" type="file" name="logo" class="block mt-1 w-full text-sm text-gray-700"
                                accept="image/*" onchange="previewLogo(event)" />
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            <div class="mt-4">
                                <img id="logo-preview" src="#" alt="Logo Preview"
                                    class="h-24 w-auto rounded border border-gray-300 hidden" />
                            </div>
                        </div>
                        <x-primary-button type="submit">{{ __('Create Company') }}</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logo-preview');
            const file = event.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = '#';
                preview.classList.add('hidden');
            }
        }
    </script>

</x-app-layout>