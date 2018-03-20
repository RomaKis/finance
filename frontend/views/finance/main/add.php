<?php use yii\helpers\Url;

$this->title = 'Add';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="add-base">

    <div class="add-rate">
        <h3><a href="<?php echo Url::to(['finance/rate/add'])?>" >Add rate</a></h3>
    </div>

    <div class="add-stock">
        <h3><a href="<?php echo Url::to(['finance/stock/add'])?>" >Add stock</a></h3>
    </div>

    <div class="add-source">
        <h3><a href="<?php echo Url::to(['finance/source/add'])?>" >Add source</a></h3>
    </div>

    <div class="add-finance-details">
        <h3><a href="<?php echo Url::to(['finance/details/add'])?>" >Add finance details</a></h3>
    </div>
</div>
