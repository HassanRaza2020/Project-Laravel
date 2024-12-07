



   
   
   

    <div class="chat-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5>Users</h5>
            <ul class="list-group">






 @foreach ( $receivers as $receivers )
             
         <li class="list-group-item">
            
            <a href=""style="text-decoration: none;">  {{$receivers->receiver_name}} 
                
                </a></li>
    
         @endforeach       
                      
            </div>


    