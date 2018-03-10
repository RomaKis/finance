<?php use yii\helpers\Url; ?>

<div class="add-base">
    <div class="add-stock">
        <h3><a href="<?php echo Url::to(['add-stock'])?>" >Add stock</a></h3>
    </div>

    <div class="add-source">
        <h3><a href="<?php echo Url::to(['add-source'])?>" >Add source</a></h3>
    </div>

    <div class="add-finance">
        <h3><a href="<?php echo Url::to(['add-finance'])?>" >Add finance</a></h3>
    </div>

    <div class="add-finance-details">
        <h3><a href="<?php echo Url::to(['add-finance-details'])?>" >Add finance details</a></h3>
    </div>
</div>
