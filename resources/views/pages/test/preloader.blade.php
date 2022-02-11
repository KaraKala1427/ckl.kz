@include('mini_parts.overloader')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


    $('#overLoader').show();
    setTimeout(function () {

        var hostname = window.location.hostname;

        window.location.href = "https://" + hostname + "/covid/success-payment/?productOrderId=" + {{$order_id}} +"&hash=" + '{{$hash}}';

    }, 15000);


</script>


