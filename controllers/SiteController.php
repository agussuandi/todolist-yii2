<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\Todolist;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $todolist = Todolist::find();

        $dataProvider = new ActiveDataProvider([
			'query' => $todolist,
			'pagination' => [
				'pageSize' => 10, 
			],
		]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionStore()
    {
        try
        {
            $request = Yii::$app->request;
            if ($request->post())
            {
                $transaction = Yii::$app->db->beginTransaction();
                $todolist                = new Todolist;
                $todolist->kegiatan      = $request->post()['kegiatan'];
                $todolist->kegiatan_date = $request->post()['tanggal'];
                $todolist->created_at    = date('Y-m-d H:i:s');
                $todolist->save(false);
                $transaction->commit();
                Yii::$app->session->setFlash('success', "Todolist berhasil dibuat.");       
            }
            else
            {
                Yii::$app->session->setFlash('error', "Method not allowed.");
            }

            return $this->goBack(Yii::$app->request->referrer);
        }
        catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error', "Todolist gagal dibuat.");
            return $this->goBack(Yii::$app->request->referrer);
        }
    }

    public function actionDestroy($id)
    {
        try
        {
            $request = Yii::$app->request;
            if ($request->post())
            {
                $transaction = Yii::$app->db->beginTransaction();
                $todolist = Todolist::findOne($id);
                $todolist->delete();
                $transaction->commit();
                Yii::$app->session->setFlash('success', "Todolist berhasil dihapus.");       
            }
            else
            {
                Yii::$app->session->setFlash('error', "Method not allowed.");
            }

            return $this->goBack(Yii::$app->request->referrer);
        }
        catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error', "Todolist gagal dihapus.");
            return $this->goBack(Yii::$app->request->referrer);
        }
    }

    public function actionUpdate($id)
    {
        try
        {
            $request = Yii::$app->request;
            if ($request->post())
            {
                $transaction = Yii::$app->db->beginTransaction();
                $todolist                = Todolist::findOne($id);
                $todolist->kegiatan      = $request->post()['kegiatan'];
                $todolist->kegiatan_date = $request->post()['tanggal'];
                $todolist->updated_at    = date('Y-m-d H:i:s');
                $todolist->save(false);
                $transaction->commit();
                Yii::$app->session->setFlash('success', "Todolist berhasil diubah.");       
            }
            else
            {
                Yii::$app->session->setFlash('error', "Method not allowed.");
            }

            return $this->goBack(Yii::$app->request->referrer);
        }
        catch (\Exception $e)
        {
            Yii::$app->session->setFlash('error', "Todolist gagal diubah.");
            return $this->goBack(Yii::$app->request->referrer);
        }
    }
}
