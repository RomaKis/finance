<?php

use frontend\models\resource\finance\Stock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Add Stock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-stock">
    <h3>Existing Stocks</h3>
    <?php
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => Stock::find()->all(),

    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
    ?>
    <h3>Add Stock</h3>

    <?php $form = ActiveForm::begin(['id' => 'stock-form']); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'stock-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
