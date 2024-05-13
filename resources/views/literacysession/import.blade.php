<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import xlsx Data') }}
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
                <form method="POST" action="{{ route('literacysession.import') }}" enctype="multipart/form-data">
                    <div class="step"></div>
                    @csrf
                    <div class="mb-6">
                        <label for="file" class="mb-2 inline-block text-neutral-700 ">Excel File</label>
                        <input type="file" id="file" name="file" class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none" multiple />
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />                 
                    </div>
                    <input type="submit" value="Submit" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 submit">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

        });
    </script>
</x-app-layout>