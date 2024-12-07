<!-- Chat Area -->
<div class="chat-area">
    <!-- Chat Header -->
    <div class="chat-header">{{request('username')}}</div>

    <!-- Chat Messages -->
    <div class="chat-messages">
        <div class="message other">

            <div class="content">{{request('title')}}</div>
            <small>{{request('time')}}</small>
        
        
        </div>
        <div class="message user">

            @foreach ($chat as $chat )
            
            <div class="content">{{$chat->message}}</div>
            <small>{{$chat->created_at->format('g:i a')}}</small>
        
            @endforeach
            
        
        </div>


    </div>

    <!-- Chat Footer -->
    <div class="chat-footer">

    <form id="messageForm" action="{{route('send-message')}}" method="POST">

        @csrf
         
        <input type="text" id="messageInput" name="message" placeholder="Type your message...">
        <input hidden name="receiver_name" value="{{request('username')}}">
        <input hidden name="receiver_id" value="{{request('user_id')}}">

        <button class="btn btn-danger" type="submit">Send</button>
    </form>
        


    </div>
</div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('messageForm').addEventListener('submit', function (e) {
    // Clear the input after submission
    setTimeout(() => {
        document.getElementById('messageInput').value = '';
    }, 100); // Optional: Delay to ensure request is processed first
});
</script>
