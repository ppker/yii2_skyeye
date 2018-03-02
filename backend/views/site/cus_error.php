<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/7/10
 * Time: 18:00
 * Desc:
 */
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
        <hr>
        <?= nl2br(Html::encode($exception)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>