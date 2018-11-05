<?php

/* @var $this components\View */

use components\Html;

/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

<pre><?php echo $exception ? $exception->getTraceAsString() : 'Trace not awailable';?></pre>

</div>
