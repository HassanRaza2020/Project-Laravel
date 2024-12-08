
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
        body{
    bottom: 0;        
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
    width: 20%;
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
    width: 460%;
    display: flex;
    flex-direction: column;
}

/* Chat Header */
.chat-header {
    background-color: #d9534f;
    color: white;
    text-align: center;
    padding: 15px;
    font-size: 1.2rem;
    font-weight: bold;
}

/* Chat Messages */
.chat-messages {
    flex: 1;
    padding: 15px;
    background-color: #f4f4f4;
    overflow-y: auto;
    margin-top: 10px;
}

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
    padding: 12px;
    border-radius: 12px;
    max-width: 80%;
    word-wrap: break-word;
    margin-left: 10px;
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

/* Chat Footer */
.chat-footer {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #fff;
    border-top: 1px solid #ddd;
}

.chat-footer input {
    flex: 1;
    padding: 10px;
    border-radius: 25px;
    font-size: 0.9rem;
    border: 1px solid #ccc;
    outline: none;
}

.chat-footer input:focus {
    border-color: #d9534f;
}

.chat-footer button {
    background-color: #d9534f;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1rem;
    margin-left: 10px;
}

.chat-footer button:hover {
    background-color: #c9302c;
}

/* Mobile view */
@media (max-width: 768px) {
    .chat-container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        border-right: none;
        padding: 15px;
    }

    .chat-area {
        width: 70%;
    }

    .chat-header {
        font-size: 1rem;
        padding: 10px;
    }

    .message .content {
        max-width: 90%;
    }
}

        </style>
</head>
<body>



    <div class="chat-container">
        <!-- Sidebar (Static Content) -->
        @include('chat.chat_module')
    
        <!-- Dynamic Chat View -->
        <div id="subview-container">
            @include('chat.chat-view')
        </div>
    </div>
    
    <script>
        // Add event listener to dynamically load chat views
        document.querySelectorAll('.load-chat-view').forEach(link => {
            link.addEventListener('click', function () {
                const url = this.dataset.url;
    
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        // Load the fetched HTML into the subview container
                        document.getElementById('subview-container').innerHTML = html;
                    })
                    .catch(err => console.error('Failed to load chat view:', err));
            });
        });
    </script>
    
</body>
</html>

