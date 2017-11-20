@section("footer")
    <!-- SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo asset("vendor/js/materialize.min.js") ?>"></script>
    <!-- MDB core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.js"></script>
    <script>

      var pusher = new Pusher('874b90015b50b115b1fb', {
        cluster: 'eu',
        encrypted: true
      });
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      var channel = pusher.subscribe('my-channel');
      channel.bind('my_event', function(data) {
        toastr[data.type](data.message)
        $.get(location.href).then(function(page) {
         $("#stockRow").html($(page).find("#stockRow").html())
        })
      });
    </script>
<script>
  document.getElementById('inputSAPCode').onkeydown = function() {
  if (this.value.length == 11)
   document.getElementById('inputSAPLoc').focus();
  }
  document.getElementById('inputSAPLoc').onkeydown = function() {
  if (this.value.length == 7)
   document.getElementById('inputSAPQuantity').focus();
  }
</script>
<script>
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
});
  $(document).ready(function() {
  $('.modal-trigger').leanModal();
});
</script>


</body>

</html>
@show