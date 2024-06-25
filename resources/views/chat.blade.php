<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="messages" class="p-6 text-gray-900 dark:text-gray-100">

                </div>
                <div class="p-6 text-gray-900 form-group">
                    <textarea class="form-control" placeholder="Enter your message" id="message-text-area" rows="3"></textarea>
                    <button id="send-button"> Send </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
