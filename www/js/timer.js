$(document).ready(function() {
    var $timeOuts = $('.timer'),
        format = function(value) {
            if (!value) {
                return '00';
            }
            if (value < 10) {
                return '0'+value;
            }
            return value;
        },
        timer = window.setInterval(function() {
            $timeOuts.each(function() {
                var $this = $(this),
                    seconds = $this.attr('seconds');
                seconds--;
                if (seconds == 0) {
                    clearInterval(timer);
                    location.reload();
                } else if (seconds > 0) {
                    $this.attr('seconds', seconds);
                    hours = Math.floor(seconds/3600);
                    minutes = Math.floor(seconds/60)%60;
                    seconds = seconds%60;
                    $this.html(
                        format(hours)+':'+format(minutes)+':'+format(seconds)
                    );
                }
            });
        },1000);

});