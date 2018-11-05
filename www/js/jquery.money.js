/**
 * Created with JetBrains PhpStorm.
 * User: ZyManch
 * Date: 09.12.12
 * Time: 9:03
 */
(function($, window) {

    var moneyArray = {};
    var timer = null;

    $.fn.toMoneyFormat = function(ext) {
        if (this.length ==0) {
            return '0'+ext;
        }
        var value =Math.round(this[0]).toString();
        var i = value.length - 3;
        while (i>0) {
            value = [value.slice(0, i), ',', value.slice(i)].join('');
            i-=3;
        }
        return value + ext;
    }

    $.fn.money = function(options) {

        var make = function() {
            var $this = $(this);
            var currencyId = $this.attr('currency');
            var regExpVal = /([0-9,]+)/ig;
            var html = $this.html().trim();
            var value = regExpVal.exec(html);

            $.data($this, 'money', {
                value: parseInt(value[1].replace(/,/g,''), 10),
                ext: html.substr(value[1].length),
                income: typeof options[currencyId] != 'undefined' ?  options[currencyId] : 0,
                lastUpdate: (new Date()).getTime()
            });
            moneyArray[currencyId] = $this;
        }

        var tick = function() {
            var now = (new Date()).getTime();
            var i;
            for (i in moneyArray) {
                var data = $.data(moneyArray[i], 'money');
                moneyArray[i].html(
                    $(data.value + data.income * (now - data.lastUpdate) / 3600000).toMoneyFormat(data.ext)
                );
            }

        }

        if (timer == null) {
            timer = window.setInterval(tick, 1000);
        }

        return this.each(make);
    }

    $.money = function(command, options) {
        switch (command) {
            case 'tick':

                break;
        }
    }

})(jQuery, window);
