<?php

namespace app\models;

use Yii;

class Todolist extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'todolist';
    }

    public function rules()
    {
        return [
            [['kegiatan', 'created_at'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'kegiatan' => 'kegiatan',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at'
        ];
    }
}