<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $endereco
 * @property double $latitude
 * @property double $longitude
 * @property string $nome
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'endereco', 'latitude', 'longitude', 'nome'], 'required'],
            [['password'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['username'], 'string', 'max' => 50],
            [['endereco', 'nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'endereco' => Yii::t('app', 'Endereco'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'nome' => Yii::t('app', 'Nome'),
        ];
    }
}
