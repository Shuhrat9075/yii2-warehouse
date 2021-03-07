<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chiqim".
 *
 * @property int $id
 * @property string $xaridor_id
 * @property string $ismi
 * @property string $nomi
 * @property int $miqdori_kg
 * @property int $narxi
 * @property int $jami_sum
 * @property int $berilgan_sum
 * @property int $qolgan_sum
 * @property string $sana
 */
class Chiqim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chiqim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xaridor_id', 'ismi', 'nomi'], 'required'],
            [['miqdori_kg', 'narxi', 'jami_sum', 'berilgan_sum','qolgan_sum'], 'integer'],
            [['sana'], 'safe'],
            [['xaridor_id', 'ismi', 'nomi','sana'], 'string', 'max' => 255],
        ];
    }
    public $m_sana;
    public $m_kg;
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),   
            'xaridor_id' => Yii::t('app', 'Харидор ИД'),
            'ismi' => Yii::t('app', 'Исми'),
            'nomi' => Yii::t('app', 'Номи'),
            'miqdori_kg' => Yii::t('app', 'Миқдори Кг'),
            'narxi' => Yii::t('app', 'Нархи'),
            'jami_sum' => Yii::t('app', 'Жами Сум'),
            'berilgan_sum' => Yii::t('app', 'Берилган Сум'),
            'qolgan_sum' => Yii::t('app', 'Қолган Сум'),
            'sana' => Yii::t('app', 'Сана'),
        ];
    }
}
