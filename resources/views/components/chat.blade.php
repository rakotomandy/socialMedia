@props(['email', 'usersLogin','user','receiver_id','messages'])
<main class="flex-1 bg-blue-200 p-6">
    <header>
        <h2 class="font-bold text-2xl">Chat with {{ strtoupper($user->name) }} </h2>
    </header>
    <div class="flex-1 h-full overflow-hidden">
        <div class="flex flex-col h-full">
            <div class="flex-1 overflow-y-auto">
                <div class="p-4">
                    @foreach($messages as $message)
                    <div class="mb-4">
                        <div class="flex items-start">
                            <div class="shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $message->sender_id == auth()->guard('login')->user()->id ? 'You' : $user->name }}</p>
                                <p class="mt-1 text-sm text-gray-700">{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="p-4">
                <form action="{{ route('sendMessage') }}" method="POST">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                    <div class="flex">
                        <input type="text" name="message" class="flex-1 border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Type your message...">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
