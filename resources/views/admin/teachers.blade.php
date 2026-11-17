<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teachers') }}
        </h2>
    </x-slot>

    <x-background>
        <x-section>
            <div class="p-6 text-gray-900">
                <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default rounded-md">
                    <table class="w-full text-sm text-left rtl:text-right text-body">
                        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            {{--                                    @foreach($teachers as $admin)--}}
                            <th scope="col" class="px-6 py-3 font-medium">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Class
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Level
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Action
                            </th>
                            {{--                                    @endforeach--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr class="bg-neutral-primary border-b border-default">
                                {{--                                        @foreach($admin as $info)--}}
                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ($teacher->id) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ($teacher->name) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ($teacher->email) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ($teacher->classe->title) }}
                                </td>
                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ ($teacher->classe->level->title) }}
                                </td>

                                <td class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    <div class="flex items-center justify-around">
                                        <a href="{{ route('admin.teacher.show', ['id' => $teacher->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.teacher.edit', ['id' => $teacher->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                    </div>
                                    {{--                                                <x-secondary-button>--}}
                                    {{--                                                    <a href="{{ route("admin.student.edit", $teacher->id) }}">Edit</a>--}}
                                    {{--                                                </x-secondary-button>--}}
                                </td>
                                {{--                                        @endforeach--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route(strtolower(Auth::user()->role->name) . '.add-user') }}">
                        <x-primary-button>
                            Add Teacher
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </x-section>
    </x-background>
</x-app-layout>
