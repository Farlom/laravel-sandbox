<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div
                x-data="{
    active: '@if($chats->isNotEmpty())chat-{{ $chats->first()->id }}@else chat-new @endif',
    vertical: false,
  }"
                class="flex flex-col"
                x-bind:class="{
    'sm:flex-row': vertical
  }"
            >
                <div
                    x-on:keydown.right.prevent.stop="$focus.wrap().next()"
                    x-on:keydown.left.prevent.stop="$focus.wrap().previous()"
                    x-on:keydown.home.prevent.stop="$focus.first()"
                    x-on:keydown.end.prevent.stop="$focus.last()"
                    x-bind:class="{
      'sm:w-36 sm:flex-none sm:flex-col sm:items-stretch': vertical
    }"
                    class="flex items-center text-sm"
                >
                    @foreach($chats as $chat)
                        <button
                            x-on:click="active = 'chat-{{ $chat->id }}'"
                            x-on:focus="active = 'chat-{{ $chat->id }}'"
                            type="button"
                            id="chat-{{ $chat->id }}-tab"
                            role="tab"
                            aria-controls="chat-{{ $chat->id }}-tab-pane"
                            x-bind:aria-selected="active === 'chat-{{ $chat->id }}' ? 'true' : 'false'"
                            x-bind:tabindex="active === 'chat-{{ $chat->id }}' ? '0' : '-1'"
                            x-bind:class="{
        'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100': active === 'chat-{{ $chat->id }}',
        'text-gray-500 dark:text-gray-400': active !== 'chat-{{ $chat->id }}',
      }"
                            class="z-10 -mb-px flex items-center gap-2 rounded-t-lg px-5 py-3"
                        >
                            {{ $chat->name }}
                        </button>
                    @endforeach
                    <button
                        x-on:click="active = 'chat-new'"
                        x-on:focus="active = 'chat-new'"
                        type="button"
                        id="chat-new-tab"
                        role="tab"
                        aria-controls="chat-new-tab-pane"
                        x-bind:aria-selected="active === 'chat-new' ? 'true' : 'false'"
                        x-bind:tabindex="active === 'chat-new' ? '0' : '-1'"
                        x-bind:class="{
        'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100': active === 'chat-new',
        'text-gray-500 dark:text-gray-400': active !== 'chat-new',
      }"
                        class="z-10 -mb-px flex items-center gap-2 rounded-t-lg px-5 py-3"
                    >
                        +
                    </button>
                    <!-- Nav Tabs -->
                </div>
                <!-- END Nav Tabs -->

                <!-- Tab Content -->
                <div
                    class=""
                >
                    @foreach($chats as $chat)
                        <div
                            x-show="active === 'chat-{{ $chat->id }}'"
                            id="chat-{{ $chat->id }}-tab-pane"
                            tab="tabpanel"
                            aria-labelledby="chat-{{ $chat->id }}-tab"
                            tabindex="0"
                        >

                            <div
                                class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg sm:rounded-tr-lg">
                                <div class="">
                                    @foreach($chat->messages as $message)
                                        <div class="relative w-fit py-1 px-2 rounded-lg mb-1 @if($message->type == \App\Enums\MessageTypeEnum::User) bg-indigo-400 @else bg-gray-100 @endif">{{ $message->text }}</div>
                                    @endforeach
                                </div>
                                <form action="{{ route('chats.messages.store', $chat) }}" method="POST">
                                    @csrf
                                    <div>
                                        <x-text-input id="text" name="text" type="text"
                                                      class="mt-1 block w-full" required autofocus/>
                                        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <div
                        x-show="active === 'chat-new'"
                        id="chat-new-tab-pane"
                        tab="tabpanel"
                        aria-labelledby="chat-new-tab"
                        tabindex="0"
                    >
                        <div
                            class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg sm:rounded-tr-lg">
                            <form action="{{ route('chats.store') }}" method="POST">
                                @csrf
                                <div>
                                    <x-input-label for="name" :value="__('Name')"/>
                                    <x-text-input wire:model="name" id="name" name="name" type="text"
                                                  class="mt-1 block w-full" required autofocus autocomplete="name"/>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END Tab Content -->
            </div>
            <!-- END Tabs -->
        </div>
    </div>
</x-app-layout>
