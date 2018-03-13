<?php

use frontend\models\resource\finance\Source;
use frontend\models\resource\finance\Stock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var \frontend\models\finance\Source $model */
?>

<div class="add-source">
    <h3>Existing Sources</h3>
    <table border="1" width="100%">
        <tr>
            <td>
                Id
            </td>
            <td>
                Stock Id
            </td>
            <td>
                Stock Name
            </td>
            <td>
                Source Name
            </td>
        </tr>
        <?php foreach (Source::find()->all() as $existModel) { ?>
            <tr>
                <?php foreach ($existModel->attributes as $key => $attribute) { ?>
                    <td>
                        <?php echo $attribute; ?>
                    </td>
                    <?php if ($key === 'stock_id') { ?>
                        <td>
                            <?php echo $model->getStockNameById($attribute) ?>
                        </td>
                        <?php
                    }
                } ?>
            </tr>
            <?php
        } ?>
    </table>
    <br>
    <h3>Add Source</h3>

    <?php $form = ActiveForm::begin(['id' => 'source-form']); ?>

    <?php
    $selectArray = [];
    foreach (Stock::find()->all() as $stock) {
        $selectArray[$stock->getAttribute('id')] = $stock->getAttribute('name');
    }
    ?>
    <?= $form->field($model, 'stockId')->dropDownList($selectArray) ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'source-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
