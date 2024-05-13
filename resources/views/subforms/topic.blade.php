<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Topics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                <span class="font-medium">Success alert!</span> {{ Session::get('message') }}
            </div>
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('topic.store') }}">
                    <div class="step"></div>
                    @csrf
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Enter Topic Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter Topic Title" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />                 
                    </div>
                    <input type="submit" value="Submit" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 submit">
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">


                <ul class=" divide-y divide-gray-200">
                    @if (count($topics) > 0)
                    @foreach ($topics as $topic)
                    <li class="pb-3 sm:pb-4 py-2">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate capitalize">
                                    {{$topic->title}}
                                </p>
                                <p class="text-sm text-gray-500 truncate ">
                                    {{$topic->code}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                <form action="{{route('topic.destroy', $topic->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button type="submit" class="text-white text-xs bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300  rounded-full text-sm p-2 text-center inline-flex items-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <style>
                                                svg {
                                                    fill: #e1e0e0
                                                }
                                            </style>
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                        <p>No topics added yet!</p>
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

        });
    </script>
</x-app-layout>