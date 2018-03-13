<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Finance */

use frontend\models\Finance;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>
    <table border="1" width="100%">
        <tr>
            <td>
                Date
            </td>
            <td>
                Sum UAH
            </td>

            <td>
                Sum USD
            </td>
        </tr>
        <?php foreach (\frontend\models\resource\finance\Details::findGroupedByDate() as $finance) { ?>
            <tr>
                <?php foreach ($finance->attributes as $attribute) { ?>
                <td>
                    <?php echo $attribute;
                    ?>
                    </td>
               <?php } ?>

                <td>
                    <a href="<?php echo Url::to(['finance-details', 'date' => $finance->date])?>">
                        Show  details
                    </a>
                </td>
            </tr>
            <?php
        } ?>
    </table>
</div>
