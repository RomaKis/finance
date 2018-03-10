<?php

use frontend\models\resource\finance\Stock;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="add-stock">
    <h3>Existing Stocks</h3>
    <table border="1" width="100%">
        <tr>
            <td>
                ID
            </td>
            <td>
                NAME
            </td>
        </tr>
        <?php foreach (Stock::find()->all() as $existModel) {?>
            <tr>
                <?php foreach ($existModel->attributes as $attribute) { ?>
                        <td>
                            <?php echo $attribute; ?>
                        </td>
                    <?php
                } ?>
            </tr>
            <?php
        } ?>
    </table>
    <br>
    <h3>Add Stock</h3>

    <?php $form = ActiveForm::begin(['id' => 'stock-form']); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'stock-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
