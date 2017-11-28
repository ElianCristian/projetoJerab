<?php

namespace app\controllers;

use app\models\Usuario as Usuario;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

//use mPDF;  chamada para utilizacao do plugin baixado
use mPDF;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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
	
	public function beforeAction($action) {

		if (Yii::$app->user->isGuest && Yii::$app->controller->action->id != "login") {
			Yii::$app->user->loginRequired();
		}
		//something code right here if user valid
		return true;
			
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	// Chamada para conversao em PDF, usando o mPDF
	public function actionPdf() {
 
       $mpdf = new \Mpdf\Mpdf();
		$registros = Usuario::find()->all();
		$total = count($registros);
		
		foreach($registros as $row)
        {
            $mpdf->WriteHTML ('Nome Completo: '.$row['nome_completo'].'</br>');
			$mpdf->WriteHTML ('username: '.$row['username'].'</br>');
            $mpdf->WriteHTML ('senha: '.$row['password'].'</br>');
            $mpdf->WriteHTML ('email: '.$row['email'].'</br>');
            $mpdf->WriteHTML ('<br/><br/>');
        }
        
		
	  // $mpdf->WriteHTML('<h1>Hello world!</h1>');
	   $mpdf->Output();
        exit;
    }
}
