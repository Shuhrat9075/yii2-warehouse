<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sklat".
 *
 * @property int $id
 * @property string|null $nomi
 * @property string|null $kirim_miqdor
 * @property string|null $chiqim_miqdor
 * @property string|null $qoldiq
 * @property string|null $sana
 */
class Sklat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sklat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomi', 'kirim_miqdor', 'chiqim_miqdor', 'qoldiq', 'sana'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ИД'),
            'nomi' => Yii::t('app', 'Номи'),
            'kirim_miqdor' => Yii::t('app', 'Кирим Миқдор Кг'),
            'chiqim_miqdor' => Yii::t('app', 'Чиқим Миқдор Кг'),
            'qoldiq' => Yii::t('app', 'Қолдиқ'),
            'sana' => Yii::t('app', 'Сана'),
        ];
    }
}
