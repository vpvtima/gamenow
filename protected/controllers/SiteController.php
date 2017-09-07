<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

        public function actionAbout()
        {
            $this->layout = '//templ/second-page';
            $this->pageTitle = 'О сайте';
            $this->render('about');
        }
        
        public function actionEditor()
        {
            $this->layout = '//templ/first-page';
            $this->pageTitle = 'Редактор';
            $this->render('editor');
        }
        
	public function actionGames($abbr=false)
        {
            $this->layout = '//templ/second-page';
            $this->pageTitle = $this->arr_games[$abbr]['name'];
            $this->render('games/'.$abbr);
        }
        protected $arr_games = array(
        'waw'=>array(
            'name'=>'Call of Duty: World at War',
            'img-sm'=>'/storage/pictures/waw-sm.jpg',
            'img-mid'=>'/storage/pictures/waw-mid.jpg',
            'img-big'=>'/storage/pictures/waw-big.jpg',
            'abbr'=>'waw',
        ),
        'bp'=>array(
            'name'=>'Battlestations Pacific',
            'img-sm'=>'/storage/pictures/bp-sm.jpg',
            'img-mid'=>'/storage/pictures/bp-mid.jpg',
            'img-big'=>'/storage/pictures/bp-big.jpg',
            'abbr'=>'bp',
        ),
        'se'=>array(
            'name'=>'Sniper Elite',
            'img-sm'=>'/storage/pictures/se-sm.jpg',
            'img-mid'=>'/storage/pictures/se-mid.jpg',
            'img-big'=>'/storage/pictures/se-big.jpg',
            'abbr'=>'se',
        ),
        'bf3'=>array(
            'name'=>'Battlefield 3',
            'img-sm'=>'/storage/pictures/bf3-sm.jpg',
            'img-mid'=>'/storage/pictures/bf3-mid.jpg',
            'img-big'=>'/storage/pictures/bf3-big.jpg',
            'abbr'=>'bf3',
        ),
        'wd'=>array(
            'name'=>'Watch Dogs',
            'img-sm'=>'/storage/pictures/wd-sm.jpg',
            'img-mid'=>'/storage/pictures/wd-mid.jpg',
            'img-big'=>'/storage/pictures/wd-big.jpg',
            'abbr'=>'wd',
        ),
        'ac'=>array(
            'name'=>'Assassin\'s Creed',
            'img-sm'=>'/storage/pictures/ac-sm.jpg',
            'img-mid'=>'/storage/pictures/ac-mid.jpg',
            'img-big'=>'/storage/pictures/ac-big.jpg',
            'abbr'=>'ac',
        ),
        'vtv2'=>array(
            'name'=>'В тылу врага 2',
            'img-sm'=>'/storage/pictures/vtv2-sm.jpg',
            'img-mid'=>'/storage/pictures/vtv2-mid.jpg',
            'img-big'=>'/storage/pictures/vtv2-big.jpg',
            'abbr'=>'vtv2',
        ),
        'ci4'=>array(
            'name'=>'Civilization IV',
            'img-sm'=>'/storage/pictures/ci4-sm.jpg',
            'img-mid'=>'/storage/pictures/ci4-mid.jpg',
            'img-big'=>'/storage/pictures/ci4-big.jpg',
            'abbr'=>'ci4',
        ),
        'mw2'=>array(
            'name'=>'Call of Duty: Modern Warfare 2',
            'img-sm'=>'/storage/pictures/mw2-sm.jpg',
            'img-mid'=>'/storage/pictures/mw2-mid.jpg',
            'img-big'=>'/storage/pictures/mv2-big.jpg',
            'abbr'=>'mw2',
        ),    
    );
        
        public function randomBanner()
        {
            $arr = $this->arr_games;
            shuffle($arr);
            $cur = current($arr);
            $url = $this->createUrl('site/games', array('abbr'=>$cur['abbr']));
            $img = "<a href='$url'><img class='img-thumbnail' src='{$cur['img-sm']}'></a>";
            return $img;
        }
        
	public function actionIndex()
	{
		$this->layout = '//templ/first-page';
                $this->pageTitle = 'GameNow';
		$this->render('index');
	}
        
        public function actionPhotos()
	{
		$this->layout = '//templ/second-page';
                $this->pageTitle = 'Фото';
		$this->render('photos');
	}
        
        public function actionLinks()
	{
		$this->layout = '//templ/second-page';
                $this->pageTitle = 'Ссылки';
		$this->render('links');
	}
        
        public function actionVideos()
	{
		$this->layout = '//templ/second-page';
                $this->pageTitle = 'Видео';
		$this->render('videos');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionFeedback()
        {
            $this->pageTitle = 'Обратная связь';
            $this->layout = '//templ/second-page';

            $model=new ContactForm;
            if(isset($_POST['ContactForm']))
            {
                $model->attributes=$_POST['ContactForm'];
                $model->subject = "Письмо из формы обратной связи";
                if($model->validate())
                {
                    $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                    $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                    $headers="From: $name <{$model->email}>\r\n".
                            "Reply-To: {$model->email}\r\n".
                            "MIME-Version: 1.0\r\n".
                            "Content-Type: text/plain; charset=UTF-8";
                    mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                    Yii::app()->user->setFlash('contact','Спасибо за ваше письмо. Ответ на него вы получите в ближайшее время.');
                    $this->refresh();
                }
            }
            $this->render('feedback',array('model'=>$model));

        }  
        
        public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                        "Reply-To: {$model->email}\r\n".
                        "MIME-Version: 1.0\r\n".
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model=new LoginForm;
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                    $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
        
}