<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $nomi
 * @property string $qayerdan
 * @property string $transport
 * @property int $miqdori_kg
 * @property string $sana
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomi', 'qayerdan', 'transport'], 'required'],
            [['miqdori_kg'], 'integer'],
            [['nomi', 'qayerdan', 'transport'], 'string', 'max' => 255],
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
            'qayerdan' => Yii::t('app', 'Қаердан'),
            'transport' => Yii::t('app', 'Транспорт'),
            'miqdori_kg' => Yii::t('app', 'Миқдори Кг'),
            'sana' => Yii::t('app', 'Сана'),
        ];
    }
}
