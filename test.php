<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script>

  
  $(document).ready(function(){
  
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('8b0b2513a24ba1333b92', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });





 }); 

  </script>