<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $idCategoria
 * @property string $categoria
 *
 * @property Produto[] $produtos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => Yii::t('app', 'Id Categoria'),
            'categoria' => Yii::t('app', 'Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['Categoria_idCategoria' => 'idCategoria']);
    }
}
