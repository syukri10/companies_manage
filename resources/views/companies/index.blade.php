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
                    <x-primary-button class="mb-4" onclick="window.location='{{ route('companies.create') }}'">
                        {{ __('Add New Company') }}
                    </x-primary-button>

                    <div class="overflow-x-auto rounded-lg shadow mt-4">
                        <table class="w-full table-auto bg-white border border-gray-300 rounded-lg">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-bold text-blue-800 uppercase border-b border-gray-300">
                                        Logo</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-bold text-blue-800 uppercase border-b border-gray-300">
                                        Name</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-bold text-blue-800 uppercase border-b border-gray-300">
                                        Email</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-bold text-blue-800 uppercase border-b border-gray-300">
                                        Website</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-bold text-blue-800 uppercase border-b border-gray-300">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($companies as $company)
                                    <tr class="hover:bg-blue-50">
                                        <td class="px-6 py-4 text-sm text-gray-700 border-b border-gray-300">
                                            @if ($company->logo)
                                                <div class="flex justify-center items-center">
                                                    <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="Logo"
                                                        class="rounded object-cover" style="width: 40px; height: 40px;" />
                                                </div>
                                            @else
                                                <div class="text-center text-gray-400">-</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 border-b border-gray-300">
                                            <div class="flex justify-center items-center">
                                                {{ $company->name }}
                                        </td>
                                        </div>
                                        <td class="px-6 py-4 text-sm text-gray-700 border-b border-gray-300">
                                            <div class="flex justify-center items-center">
                                                {{ $company->email }}
                                        </td>
                                    </div>
                                    <td class="px-6 py-4 text-sm text-blue-600 border-b border-gray-300">
                                        <div class="flex justify-center items-center">
                                            <a href="{{ $company->website }}" target="_blank" class="hover:underline">
                                                {{ $company->website }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 border-b border-gray-300">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('companies.edit', $company->id) }}">
                                                <button class="px-3 py-1 rounded text-white"
                                                    style="background-color: #3b82f6;">Edit</button>
                                            </a>
                                            <a href="{{ route('companies.show', $company->id) }}">
                                                <button class="px-3 py-1 rounded text-white"
                                                    style="background-color: #34eb9b;">Show</button>
                                            </a>
                                            <form method="POST" action="{{ route('companies.destroy', $company->id) }}"
                                                onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="px-3 py-1 rounded text-white"
                                                    style="background-color: #ef4444;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    </tr>
                                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-sm text-gray-500 border-b border-gray-300">
                            No data available.
                        </td>
                    </tr>
                @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>