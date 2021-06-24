<x-app-layout :title="__('Actions Tracker')">

    @if (session()->has('success_message'))
        <div class="mb-2">
            <x-alert :type="'success'">
                {{ session()->get('success_message') }}
            </x-alert>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="mb-2">
                <x-alert :type="'error'">
                    {{ $error }}
                </x-alert>
            </div>
        @endforeach
    @endif

    <div class="flex justify-content-between">

        <form method="post" action="/action" id="new-action-form" class="rounded px-2 py-4 border-t-2 shadow-md flex flex-col w-96 self-start">
            @csrf

            <strong class="uppercase mb-8">
                {{ __('New action') }}
            </strong>

            <div class="flex justify-between">
                <input type="text"
                       name="title"
                       placeholder="{{ __('Title') }}"
                       autocomplete="off"
                       class="rounded my-1 p-2 flex-grow mr-2 focus:outline-none focus:ring-2 ring-gray-300">
                <input type="text"
                       name="time"
                       placeholder="{{ __('Time') }}"
                       autocomplete="off"
                       class="rounded my-1 p-2 w-20 focus:outline-none focus:ring-2 ring-gray-300">
            </div>
            <textarea name="description"
                      placeholder="{{ __('Description') }}"
                      autocomplete="off"
                      class="rounded my-1 p-2 h-24 focus:outline-none focus:ring-2 ring-gray-300"></textarea>

            <div class="mt-8 text-right">
                <button type="button"
                        id="new-action-form-reset-btn"
                        class="mr-8 text-red-400 hover:text-red-500 focus:outline-none transition duration-300 ease-in-out">
                    {{ __('Reset') }}
                </button>

                <button type="submit"
                        class="w-20 bg-blue-500 hover:bg-transparent text-white font-semibold hover:text-blue-700 py-2 px-4 border border-transparent hover:border-blue-500 rounded focus:outline-none transition duration-300 ease-in-out">
                    {{ __('Add') }}
                </button>
            </div>

        </form>

        <div class="flex-grow ml-48">
            @foreach ($todaysActions as $todaysActionTitle => $todaysActionData)
                <div class="js-related-actions-block mb-4">
                    <strong>
                        {{ $todaysActionTitle }}:
                    </strong>
                    @foreach ($todaysActionData as $todaysAction)
                        <div class="js-action-block flex justify-between pl-8">
                            <textarea name="description"
                                      autocomplete="off"
                                      class="js-action-description rounded my-1 p-2 h-10 flex-grow focus:outline-none focus:ring-2 ring-gray-300">{{ $todaysAction['description'] }}</textarea>
                            <input type="text"
                                   name="time"
                                   value="{{ $todaysAction['minutes_spent'] }}"
                                   autocomplete="off"
                                   class="rounded my-1 p-2 w-20 mx-2 self-start focus:outline-none focus:ring-2 ring-gray-300">
                            <button type="button" data-id="{{ $todaysAction['id'] }}" class="js-action-delete-btn self-start h-10 my-1 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="#f87171">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7  8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>

</x-app-layout>