<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route(strtolower(Auth::user()->role->name) . '.add-user') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                                          autofocus autocomplete="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                                          autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- User Role -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')"/>
                            <select name="role" id="role" class="w-full rounded-md border border-gray-300">
                                @foreach(App\Enum\UserRole::cases() as $user_role)
                                        <option type="text" value="{{ $user_role }}"
                                                class="block mt-1 w-full text-gray-400">{{ $user_role }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                        </div>

                        <!-- Class Name -->
                        <div class="mt-4">
                            <x-input-label for="classe" :value="__('Classe')"/>
                            <select name="class_id" id="classe" class="w-full rounded-md border border-gray-300 ">
                                @foreach($classes as $class)
                                    <option type="text" value="{{ $class->id }}" selected
                                            class="block mt-1 w-full text-gray-400">{{ $class->title }}</option>
                                @endforeach
                            </select>
{{--                            <x-text-input hidden id="role" name="role" value="{{ App\Enum\UserRole::Student->value }}"/>--}}
                            <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')"/>

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password"/>

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password"/>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            @session('Success')
                <div class="badge badge-success mt-5 p-5 max-w-xl max-h-24">
                    <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle><polyline points="7 13 10 16 17 8" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></polyline></g></svg>
                    {{ $value }}
                </div>
            @endsession
        </div>
    </div>
</x-app-layout>
