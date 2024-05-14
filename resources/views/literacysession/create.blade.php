<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Information Literacy Session') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                <span class="font-medium">Success alert!</span> {{ Session::get('message') }}
            </div>
            @endif
            @if ($errors->all())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
                @foreach ($errors->all() as $error)
                <span class="font-medium">Warning!</span> {{ $error }}
                <br>
                @endforeach
            </div>
            @endif
          
            <div>
                <ol class="flex items-center w-full p-3 space-x-2 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm  sm:text-base  sm:space-x-4">
                    <li class="flex items-center text-blue-600 first">
                        <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border  rounded-full shrink-0 ">
                            1
                        </span>
                        Basic <span class="hidden sm:inline-flex sm:ml-2">Info</span>
                    </li>
                    <li class="flex items-center second">
                        <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border rounded-full shrink-0">
                            2
                        </span>
                        Session <span class="hidden sm:inline-flex sm:ml-2">Info</span>

                    </li>
                    <li class="flex items-center third">
                        <span class="flex items-center justify-center w-5 h-5 mr-2 text-xs border  rounded-full shrink-0 ">
                            3
                        </span>
                        FeedBack
                    </li>
                </ol>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('literacysession.store') }}" enctype="multipart/form-data">
                    <div class="">
                        <div class="step"></div>
                        @csrf
                        <form>
                            <div class="step-1">
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@example.com">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="mb-6">
                                    <label for="attendees" class="block mb-2 text-sm font-medium text-gray-900">Session Attendees </label>
                                    <select id="attendees" name="attendees" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option>Session Attendees</option>
                                        <option value="1">Students</option>
                                        <option value="2">Faculty</option>
                                        <option value="3">Both</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('attendees')" class="mt-2" />
                                </div>
                                <div class="mb-6">
                                    <label for="identity" class="block mb-2 text-sm font-medium text-gray-900">Who are you? <span class="text-red-500">*</span></label>
                                    <input type="text" id="identity" name="identity" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Who are you?">
                                    <x-input-error :messages="$errors->get('identity')" class="mt-2" />
                                </div>
                            </div>
                            <div class="step-2 hidden">
                                <div class="mb-6">
                                    <label for="sessiondate" class="block mb-2 text-sm font-medium text-gray-900">Session Date <span class="text-red-500">*</span></label>
                                    <input type="date" name="sessiondate" id="sessiondate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <x-input-error :messages="$errors->get('sessiondate')" class="mt-2" />
                                </div>
                                <div class="mb-6">
                                    <label for="topic" class="block mb-2 text-sm font-medium text-gray-900">Topic <span class="text-red-500">*</span></label>
                                    <select id="topic" name="topic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="0">Select Topic</option>
                                        @foreach ($topics as $topic )
                                        <option value="{{$topic->title}}">{{$topic->title}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('topic')" class="mt-2" />
                                </div>

                                <div class="mb-6">
                                    <label for="participants" class="block mb-2 text-sm font-medium text-gray-900">Participants <span class="text-red-500">*</span></label>
                                    <input type="number" id="participants" name="participants" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter number of participants">
                                    <x-input-error :messages="$errors->get('participants')" class="mt-2" />
                                </div>

                                <div class="mb-6">
                                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900">Faculty / Department <span class="text-red-500">*</span></label>
                                    <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="0">Select Department</option>
                                        @foreach ($departments as $department )
                                        <option value="{{$department->name}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                </div>

                                <div class="mb-6">
                                    <label for="program" class="block mb-2 text-sm font-medium text-gray-900">Program <span class="text-red-500">*</span></label>
                                    <select id="program" name="program" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="0">Select Program</option>
                                        @foreach ($programs as $program )
                                        <option value="{{$program->name}}">{{$program->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('program')" class="mt-2" />
                                </div>

                                <div class="mb-6">
                                    <label for="campus" class="block mb-2 text-sm font-medium text-gray-900">Campus <span class="text-red-500">*</span></label>
                                    <select id="campus" name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option value="0">Select Campus</option>
                                        @foreach ($campuses as $campus )
                                        <option value="{{$campus->name}}">{{$campus->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('campus')" class="mt-2" />
                                </div>
                                <div class="mb-6">
                                    <label for="conductedby" class="block mb-2 text-sm font-medium text-gray-900">Session Conducted By <span class="text-red-500">*</span></label>
                                    <input type="text" name="conductedby" id="conductedby" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Session Conducted by">
                                    <x-input-error :messages="$errors->get('conductedby')" class="mt-2" />
                                </div>

                                <div class="mb-3">
                                    <label for="images" class="mb-2 inline-block text-neutral-700 ">Session Images</label>
                                    <input type="file" id="images" name="images[]" class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none" multiple />
                                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                </div>
                            </div>

                            <div class="step-3 hidden">
                                <div class="mb-6">
                                    <label for="question_1" class="block mb-2 text-sm font-medium text-gray-900">Venue Comfortable? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_2" class="block mb-2 text-sm font-medium text-gray-900">Venue Well Located? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_2" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_2" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_2" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_2" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_2" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_3" class="block mb-2 text-sm font-medium text-gray-900">Contents Relevant? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_3" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_3" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_3" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_3" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_3" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_4" class="block mb-2 text-sm font-medium text-gray-900">Contents Comprehensive? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_5" class="block mb-2 text-sm font-medium text-gray-900">Contents Easy to Understand? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_5" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_5" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_5" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_5" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_5" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_6" class="block mb-2 text-sm font-medium text-gray-900">Session Well Placed? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_6" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_6" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_6" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_6" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_6" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_7" class="block mb-2 text-sm font-medium text-gray-900">Session Good Mix? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_7" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_7" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_7" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_7" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_7" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_8" class="block mb-2 text-sm font-medium text-gray-900">Session Duration Sufficient? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_8" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_8" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_8" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_8" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_8" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_9" class="block mb-2 text-sm font-medium text-gray-900">Useful Learning Experience? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_9" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_9" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_9" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_9" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_10" class="block mb-2 text-sm font-medium text-gray-900">Facilitator Knowledgeable? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_10" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_10" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_10" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_10" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_10" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_11" class="block mb-2 text-sm font-medium text-gray-900">Facilitator Well Prepared? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_1" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_11" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_11" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_11" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_11" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                                <div class="mb-6">
                                    <label for="question_12" class="block mb-2 text-sm font-medium text-gray-900">Facilitator Responsive? </label>
                                    <input type="number" name="strongly_agree[]" id="strongly_agree_12" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Agree">
                                    <input type="number" name="agree[]" id="agree_12" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Agree">
                                    <input type="number" name="strongly_disagree[]" id="strongly_agree_12" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="Strongly Disagree">
                                    <input type="number" name="disagree[]" id="strongly_agree_12" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder=" Disagree">
                                    <input type="number" name="no_response[]" id="strongly_agree_12" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 mb-3" placeholder="No Response">
                                </div>
                            </div>
                    </div>
            </div>
            <button type="button" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hidden button-back">Back</button>
            <button type="button" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3  button-next">Next</button>
            <input type="submit" value="Submit" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3 hidden submit">
            </form>

        </div>
    </div>
    <script>
        var step = 1;
        $(document).ready(function() {
            $(".button-next").on('click', function() {
                step++;
                if (step == 2) {
                    $(".button-back").removeClass("hidden");
                    $(".step-2").removeClass("hidden");
                    $(".step-1").addClass("hidden");
                    $(".first").removeClass("text-blue-600");
                    $(".second").addClass("text-blue-600");
                }
                if (step == 3) {
                    $(".button-back").removeClass("hidden");
                    $(".step-3").removeClass("hidden");
                    $(".submit").removeClass("hidden");
                    $(".button-next").addClass("hidden");
                    $(".step-2").addClass("hidden");
                    $(".second").removeClass("text-blue-600");
                    $(".third").addClass("text-blue-600");

                }
            });
            $(".button-back").on('click', function() {
                step--;
                if (step == 1) {
                    $(".button-back").addClass("hidden");
                    $(".step-1").removeClass("hidden");
                    $(".step-2").addClass("hidden");
                    $(".step-3").addClass("hidden");
                    $(".first").addClass("text-blue-600");
                    $(".second").removeClass("text-blue-600");
                }
                if (step == 2) {
                    $(".button-next").removeClass("hidden");
                    $(".step-1").addClass("hidden");
                    $(".step-2").removeClass("hidden");
                    $(".step-3").addClass("hidden");
                    $(".submit").addClass("hidden");
                    $(".second").addClass("text-blue-600");
                    $(".third").removeClass("text-blue-600");
                }

                if (step == 3) {
                    $(".button-next").removeClass("hidden");
                    $(".step-3").removeClass("hidden");
                    $(".step-2").addClass("hidden");
                }

            });


        });
    </script>
</x-app-layout>