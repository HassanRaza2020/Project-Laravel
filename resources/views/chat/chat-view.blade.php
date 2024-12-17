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
            <input type="text" id="messageInput" name="message" placeholder="Type your message..." required>
            <input type="hidden" name="receiver_name" value="{{ request('username') }}">
            <input type="hidden" name="receiver_id" value="{{ request('user_id') ?? request('receiver_id') }}">
        
            <button class="btn btn-danger" type="button" onclick="sendMessage()">Send</button>
        </form>
            </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // alert('yes');

// $(document).ready(function() {
    function sendMessage() {
    // Get the form data
    var formData = $('#messageForm').serialize();

    // Send AJAX request
    $.ajax({
        url: $('#messageForm').attr('action'), // The form action URL
        type: 'POST', // Use POST method (from the form)
        data: formData, // The serialized form data
        success: function(response) {
            // Handle the successful response
            alert('Message sent successfully!');
            // Optionally, clear the input or reset the form
            $('#messageInput').val('');
        },
        error: function(xhr, status, error) {
            // Handle the error response
            alert('An error occurred while sending the message.');
        }
    });
}

        const receiverId = "{{ request('user_id') ?? request('receiver_id') }}";
    
        Echo.private('my-channel')
            .listen('SendUserMessage', (e) => {
                console.log('New Message:', e);
            })
            .error((error) => {
                console.error('Echo Error:', error);
            });




            Echo.private('my-channel')
              .listen('SendUserMessage', (event) => {
                   console.log('New message received:', event);
        // You should see the message object logged here
    });




    </script>
    




    </div>
</div>
