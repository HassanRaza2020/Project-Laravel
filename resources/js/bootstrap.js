import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '244a5e6fc9854d8c119a',
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,
    disableStats: true,
});
window.Echo.private('my-channel')
    .listen('NewMessageEvent', (event) => {
        console.log(event);
    });


      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('244a5e6fc9854d8c119a', {
        cluster: 'eu'
      });
  
      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
      });

      