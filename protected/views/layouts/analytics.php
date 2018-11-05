<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 17.02.13
 * Time: 9:41
 */
?>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?=\Yii::$app->params['analytics'];?>']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>