<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tender".
 *
 * @property int $id
 * @property int $tenderID
 * @property string $description
 * @property float|null $amount
 * @property int|null $dateModified
 */
class Tender extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenderID', 'description'], 'required'],
            [['dateModified'], 'integer'],
            [['amount'], 'number'],
            [['tenderID'], 'string', 'max' => 256],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenderID' => 'Tender ID',
            'description' => 'Description',
            'amount' => 'Amount',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return string
     */
    public function getDate_Modified()
    {
        return Yii::$app->formatter->asDatetime($this->dateModified);
    }
}
