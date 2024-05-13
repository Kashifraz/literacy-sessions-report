<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Download Word Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                <span class="font-medium">Success alert!</span> {{ Session::get('message') }}
            </div>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-5">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Topic
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Session Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Campus
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($sessions as $session )
                        <tr class="bg-white border-b ">
                            <td scope="row" class="px-6 ">
                                {{$session->conductedby}}
                            </td>
                            <td class="px-6 py-4">
                                {{$session->topic}}
                            </td>
                            <td class="px-6 py-4">
                                {{$session->sessiondate}}
                            </td>
                            <td class="px-6 py-4">
                                {{$session->campus}}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/literacysession/generateword/{{$session->id}}" class="font-medium text-blue-600 hover:underline">generate</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $sessions->links() }}
        </div>


    </div>
    </div>
</x-app-layout>