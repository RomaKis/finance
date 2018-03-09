<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\FinanceForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-finance">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create new finance:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-finance']); ?>

            <?= $form->field($model, 'stock')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'source') ?>

            <?= $form->field($model, 'sum') ?>

            <?= $form->field($model, 'currency') ?>

            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'finance-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
