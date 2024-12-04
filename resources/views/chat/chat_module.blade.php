<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('5310f472865ffc7765be', {
          cluster: 'ap2'
        });
    
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          alert(JSON.stringify(data));
        });
      </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .chat-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        /* Sidebar styling */
        .sidebar {
            width: 25%;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            padding: 10px;
            overflow-y: auto;
        }
        .sidebar h5 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .list-group-item {
            cursor: pointer;
        }
        /* Chat area styling */
        .chat-area {
            width: 75%;
            display: flex;
            flex-direction: column;
        }
        .chat-header {
            background-color: #d9534f;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .chat-messages {
            flex: 1;
            padding: 15px;
            background-color: #f4f4f4;
            overflow-y: auto;
        }
        .chat-footer {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
        .chat-footer input {
            flex: 1;
            margin-right: 10px;
        }
        /* Message styling */
        .message {
            margin-bottom: 15px;
        }
        .message.other {
            text-align: left;
        }
        .message.user {
            text-align: right;
        }
        .message .content {
            display: inline-block;
            padding: 10px;
            border-radius: 15px;
            max-width: 70%;
        }
        .message.other .content {
            background-color: #e9ecef;
        }
        .message.user .content {
            background-color: #d9534f;
            color: white;
        }
        .message small {
            display: block;
            margin-top: 5px;
            font-size: 0.75rem;
            color: gray;
        }
    </style>
</head>
<body>


    @include('header.navbar')
    <!-- Chat Interface -->
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5>Users</h5>
            <ul class="list-group">
                <li class="list-group-item">User 1</li>
                <li class="list-group-item">User 2</li>
                <li class="list-group-item">User 3</li>
                <li class="list-group-item">User 4</li>
            </ul>
        </div>

        <!-- Chat Area -->
        <div class="chat-area">
            <!-- Chat Header -->
            <div class="chat-header">Chat Room</div>

            <!-- Chat Messages -->
            <div class="chat-messages">
                <div class="message other">
                    <div class="content">Hello! How are you?</div>
                    <small>10:45 AM</small>
                </div>
                <div class="message user">
                    <div class="content">I'm doing great, thank you!</div>
                    <small>10:46 AM</small>
                </div>
            </div>

            <!-- Chat Footer -->
            <div class="chat-footer">
                <input type="text" class="form-control" placeholder="Type your message...">
                <button class="btn btn-danger">Send</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
