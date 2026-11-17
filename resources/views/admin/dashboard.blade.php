<x-app-layout>
    @php
        $roles_colors = [
            'Student' => 'accent',
            'Teacher' => 'warning'
        ];

        $card_colors = ['primary', 'secondary', 'error', 'neutral', 'success']
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ 'Hello, ' . Auth::user()->name . '!' }}
                </div>
            </div>
            <x-section>
                <div>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Total Users') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('All the user with different roles in the data base will appear here.') }}
                    </p>
                </div>
                <div class="flex justify-center items-center w-fit">

                <div class="flex justify-around gap-5 items-center flex-wrap mt-5 w-fit">
                    @foreach($users as $user)
                        <x-user-card-body title="{{ $user->name }}" class="border-gray-200 shadow-lg">

                            <p>{{ $user->email }}</p>
                            <div class="badge badge-{{ $roles_colors[$user->role->name] }}">
                                {{ $user->role->name }}
                            </div>

                            <div class="card-actions justify-end">
                                <a class="btn btn-info" href="{{ route('admin.' . strtolower($user->role->name) . '.show', $user->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>
                                    <button>View Details</button>
                                </a>
                            </div>
                        </x-user-card-body>
                    @endforeach
                </div>
                </div>

            </x-section>
        </div>
    </div>


</x-app-layout>
