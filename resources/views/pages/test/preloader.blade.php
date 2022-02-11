@include('mini_parts.overloader')


<h1><span id="seconds">60</span>
    секунд
</h1>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


    function checkOrderStatus() {

        var hostname = window.location.hostname;

        console.log("ajax begin");
        $.ajax({
            type: "POST",
            url: "{{route('covid.checkOrderStatus')}}",
            data: {
                productOrderId: '{{$order_id}}',
                hash: '{{$hash}}',
                _token: '{{csrf_token()}}'
            },

            success: function (data) {
                $('#overLoader').hide();
                if (data.success == true) {

                    console.log("URAAAAAAAAA");
                    window.location.href = "https://" + hostname + "/covid/success-payment/?productOrderId=" + {{$order_id ?? ''}} +"&hash=" + '{{$hash ?? ''}}' + "&reloaded=1";

                }
            },

        });
    }

    const time = $('.seconds');
    intervalId = setInterval(timerDecrement, 1000);

    function timerDecrement() {

        console.log("TIMECHECK");
        const newTime = time.text() - 1;

        time.text(newTime);

        if(newTime % 5 === 0){

            checkOrderStatus();

            console.log("CECHK PROWEL");
        }

        if (newTime === 0) {

            var hostname = window.location.hostname;

            window.location.href = "https://" + hostname + "/covid/success-payment/?productOrderId=" + {{$order_id}} +"&hash=" + '{{$hash}}' + "&reloaded=1";

            console.log("CECHK PROWEL1");
        }
    }


    $('#overLoader').show();


</script>


