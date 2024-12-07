
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body, html 
        {
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

@include('chat.chat_module')
@include('chat.chat-view')
   
   
   


        

</body>
</html>

