<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Source;
use Yii;
use frontend\models\resource\finance\Source as ResourceSource;
use yii\helpers\Json;

class SourceController extends AccessLoginOnly
{
    public function actionAdd()
    {
        $model = new Source();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model = new Source();
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionGetByStockId()
    {
        if (isset($_POST['depdrop_parents']) && $_POST['depdrop_parents'] != null) {
            $output = [];
            $sourceArray = [];
            foreach (ResourceSource::find()->where(['stock_id' => $_POST['depdrop_parents'][0]])->all() as $source) {
                $sourceArray[$source->getAttribute('id')] = $source->getAttribute('name');
            }

            foreach ($sourceArray as $key => $value) {
                $output[] = ['id' => $key, 'name' => $value];
            }

            $selected = isset($output[0]) ? $output[0] : [];

            return Json::encode(['output' => $output, 'selected' => $selected]);
        }

        return Json::encode(['output' => '', 'selected' => '']);
    }
}
