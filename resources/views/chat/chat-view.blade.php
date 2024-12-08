<div class="chat-area">
    <!-- Chat Header -->
    <div class="chat-header">
        {{ request('username') }}
    </div>

    <!-- Chat Messages -->
    <div class="chat-messages">

        <div class="content">{{request('title')}}</div>


        @foreach ($chat as $chatMessage)
            <!-- Check if the message is from the current user or another user -->
            <div class="message {{ $chatMessage->sender_id == auth()->id() ? 'user' : 'other' }}">
                
                
                <div class="content">{{ $chatMessage->message }}</div>
                <small>{{ $chatMessage->created_at->format('g:i a') }}</small>
            </div>
        @endforeach
    </div>

    <!-- Chat Footer -->
    <div class="chat-footer">
        <form id="messageForm" action="{{ route('send-message') }}" method="POST">
            @csrf
            <input type="text" id="messageInput" name="message" placeholder="Type your message...">
            <input type="hidden" name="receiver_name" value="{{ request('username') }}">
            <input type="hidden" name="receiver_id" value="{{ request('user_id') }}">
            <input type="hidden" name="receiver_id" value="{{ request('receiver_id') }}">
            <button class="btn btn-danger" type="submit">Send</button>
        </form>
    </div>
</div>
