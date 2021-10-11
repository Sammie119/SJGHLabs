<!-- Automatically logout after 5mins of inactiveness..............................-->

{{-- <script>
    $(function () {
        $("body").on('click keypress', function () {
            ResetThisSession();
        });
    });

  var timeInSecondsAfterSessionOut = 120; // change this to change session time out (in seconds).
        var secondTick = 0;

        function ResetThisSession() {
            secondTick = 0;
        }

    function StartThisSessionTimer() {
        secondTick++;
        var timeLeft = ((timeInSecondsAfterSessionOut - secondTick) / 60).toFixed(0); // in minutes
    timeLeft = timeInSecondsAfterSessionOut - secondTick; // override, we have 30 secs only 

        $("#spanTimeLeft").html(timeLeft);

        if (secondTick > timeInSecondsAfterSessionOut) {
            clearTimeout(tick);
            window.location = "logout";
            return;
        }
        tick = setTimeout("StartThisSessionTimer()", 1000);
    }

    StartThisSessionTimer();
</script>  --}}