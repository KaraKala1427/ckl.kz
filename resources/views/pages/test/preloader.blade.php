@include('mini_parts.overloader')


<h1  align="center" style="color: red"><span id="seconds">60</span>
    секунд
</h1>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


    $('#overLoader').show();

    function checkOrderStatus() {

        var hostname = window.location.hostname;

        $.ajax({
            type: "POST",
            url: "{{route('covid.checkOrderStatus')}}",
            data: {
                productOrderId: '{{$order_id}}',
                hash: '{{$hash}}',
                _token: '{{csrf_token()}}'
            },

            success: function (data) {
                if (data.success == true) {

                    window.location.href = "https://" + hostname + "/covid/success-payment/?productOrderId=" + {{$order_id ?? ''}} +"&hash=" + '{{$hash ?? ''}}' + "&reloaded=1";

                }
            },

        });
    }

    intervalId = setInterval(timerDecrement, 1000);

    function timerDecrement() {

        var time = $('#seconds');

        const newTime = time.text() - 1;
        time.text(newTime);

        if (newTime % 5 === 0) {

            checkOrderStatus();

        }

        if (newTime === 0) {

            var hostname = window.location.hostname;

            window.location.href = "https://" + hostname + "/covid/success-payment/?productOrderId=" + {{$order_id}} +"&hash=" + '{{$hash}}' + "&reloaded=1";

        }
    }

</script>


