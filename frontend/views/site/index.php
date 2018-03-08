<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">Welcome to finance.</p>
        <?php if (Yii::$app->user->isGuest): ?>
            <p class="lead">Sign up or log in to have full access.</p>

        <?php endif; ?>

    </div>

    <div class="body-content">


    </div>

</div>
</div>
