<x-app-layout>
    <x-page-heading>
        {{ $student->name }}
    </x-page-heading>
    <x-background>
        <x-section class="mt-6 space-y-6 p-6">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Academic Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>

            <div class="flex gap-5">
                <div class="w-[50%]">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input disabled placeholder="{{ $student->name }}" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="w-[50%]">
                    <x-input-label for="name" :value="__('Email')" />
                    <x-text-input disabled placeholder="{{ $student->email }}" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="w-[50%]">
                    <x-input-label for="name" :value="__('Class')" />
                    <x-text-input disabled placeholder="{{ $student->classe->title }}" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Subjects Results') }}
                </h2>
            </div>
            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default rounded-md">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        {{--                                    @foreach($students as $admin)--}}
                        <th scope="col" class="px-6 py-3 font-medium">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Mark
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Result
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Note
                        </th>
                        {{--                        <th scope="col" class="px-6 py-3 font-medium">--}}
                        {{--                            Action--}}
                        {{--                        </th>--}}
                        {{--                                    @endforeach--}}
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($student->subjects) === 0)
                        <tr class="bg-neutral-primary border-b border-default p-5">
                            <td colspan="5" class="p-5 text-center">
                                No subjects were found!
                            </td>
                        </tr>
                    @endif
                    @foreach($student->subjects as $subject)
                        @php
                            $result_style = $subject->pivot->mark >= 10.00 ? 'success' : 'error';
                            $result = $subject->pivot->mark >= 10.00 ? 'A' : 'F';
                        @endphp
                        <tr class="bg-neutral-primary border-b border-default">
                            {{--                                        @foreach($admin as $info)--}}
                            <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ ($subject->id) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ ($subject->title) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ ($subject->pivot->mark) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                <span class="badge badge-{{$result_style}}">
                                    {{ $result }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ ($subject->pivot->note) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-section>
    </x-background>
</x-app-layout>
