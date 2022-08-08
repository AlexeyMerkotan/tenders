<?php

namespace common\components;

use Yii;
use yii\base\Component;
use linslin\yii2\curl;
use yii\db\Exception;
use yii\helpers\Json;
use common\models\Tender as TenderModel;

class Tender extends Component
{
    private const BASE_URL_TENDERS = 'https://public.api.openprocurement.org/api/0/tenders?descending=1&limit=10';
    private const BASE_URL_TENDER = 'https://public.api.openprocurement.org/api/0/tenders/';

    private $_curl;

    public function getTender()
    {
        $this->_curl = new curl\Curl();

        $resp = $this->_curl->get(self::BASE_URL_TENDERS);

        if ($this->_curl->errorCode !== null) {
            throw new \Exception('Error code curl ' . $this->_curl->errorCode);
        }
        $data = Json::decode($resp);
        $this->handlingTender($data);
    }

    private function handlingTender($data)
    {
        foreach ($data['data'] as $temp) {
            $resp = $this->_curl->get(self::BASE_URL_TENDER . $temp['id']);
            $tender = Json::decode($resp);
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $dateModified = strtotime($tender['data']['dateModified']);
                $model = new TenderModel([
                    'tenderID' => $temp['id'],
                    'description' => current($tender['data']['items'])['description'],
                    'amount' => $tender['data']['value']['amount'],
                    'dateModified' => $dateModified
                ]);

                if (!$model->save()) {
                    $message = null;
                    foreach ($model->getErrors() as $error) {
                        $message .= $error[0] . "\n";
                    }
                    throw new Exception($message);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();

                throw $e;
            }
            $transaction->commit();
        }

    }
}