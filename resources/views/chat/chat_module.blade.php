<div class="sidebar">
    <h5>Users</h5>
    <ul class="list-group">
        @foreach ($receivers as $receiver)
            <li class="list-group-item">
                <a href="javascript:void(0);"
                   class="load-chat-view"

                   data-url="{{ route('message', ['receiver_id' => $receiver->receiver_id, 
                     'username' => $receiver->receiver_name]) }}"   
                   style="text-decoration: none;" style="font-family:cursive ">
                    {{ $receiver->receiver_name }}
                  </a>
            </li>
        @endforeach
    </ul>
</div>
