<?php

namespace app\models;
use Yii\db\Query;
use app\models\Chiqim;
use Yii;

/**
 * This is the model class for table "xaridor".
 *
 * @property int $xaridor_id
 * @property string $ismi
 * @property string $sana
 */
class Xaridor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xaridor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ismi'], 'required'],
            [['sana'], 'safe'],
            [['ismi','sana'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'xaridor_id' => Yii::t('app', 'Харидор ИД'),
            'ismi' => Yii::t('app', 'Исми'),
            'sana' => Yii::t('app', 'Сана'),
        ];
    }

    public function getChiqim()
    {
        return $this->hasMany(Chiqim::className(), ['xaridor_id' => 'xaridor_id']);
    
    }


}
