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
                    {{-- <h3 class="mb-4"> Create New Company</h3> --}}

                    <div class="card">
                        <div class="card-body">
                            <div class="flex justify-center gap-4">
                                @if($company->logo)
                                <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="{{ $company->name }} Logo"
                                style="max-width: 200px;">
                                @else
                                <p><strong>Logo:</strong> N/A</p>
                                @endif
                            </div>
                            <h2>{{ $company->name }}</h2>
                            <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
                            <p><strong>Website:</strong>
                                @if($company->website)
                                    <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>

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