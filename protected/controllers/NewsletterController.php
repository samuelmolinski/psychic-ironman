<?php

class NewsletterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function actionSubscribe() {
		$this->layout = 'ajax';

		//print_r($_POST['Newsletter']);

		if(Yii::app()->request->isPostRequest) {
		    if(isset($_POST['Newsletter']) && $_POST['Newsletter']!=''){
    			$Newsletter = $_POST['Newsletter'];
				$model = new Newsletter;
				$model -> setScenario('Newsletter');
				$model->attributes=$_POST['Newsletter'];
		       	$r = $model -> save();
		       if($r){
		          	//print_r(json_encode($model->attributes));
		          	$url = "https://www.msf.org.br/VoluntarioVirtual/?msg=saved";
					$mail             = new PHPMailer(); // defaults to using php "mail()"
					$mail->CharSet = 'UTF-8';
					$body             = '<html style="height:100%;" >
	<head>	
		<meta charset="UTF-8" />
	</head>
	<body bgcolor="#cccccc" style="height:100%; border: none;font-family: sans-serif;background-image: url(https://www.msf.org.br/VoluntarioVirtual/images/bg-base.jpg);background-repeat:repeat;font-size: 14px;line-height: 1.5;color: #006fa5;border-top: solid 12px #eb2a3e;">
		<div style="width:600px;margin:auto;">
			<div style="width:80%;padding: 10%;">
				<a href="https://www.msf.org.br" target="_blank"><img style="margin: 10px 0;" src="https://www.msf.org.br/VoluntarioVirtual/images/logo-mediocsSemFronteiras.png"></a>
				<p>Olá,</p> 
				<p>Obrigado por ter se tornado um Voluntário Virtual de Médicos Sem Fronteiras.</p>
				<p>Além de levar cuidados de saúde de emergência àqueles que mais precisam, Médicos Sem Fronteiras também busca chamar atenção para as crises humanitárias muitas vezes esquecidas. É nosso objetivo tornar públicas as situações de sofrimento que nossos profissionais encontram. E você pode nos ajudar nessa missão, levando a nossa mensagem ainda mais longe.</p> 
				<p>A Página do Voluntário Virtual é o espaço onde vamos sugerir ideais para você divulgar a nossa causa junto à sua rede de relacionamento na internet, fazendo com que mais pessoas tomem conhecimento do que realmente está acontecendo. Veja nossas sugestões e ajude a espalhar nossas mensagens. Contamos com você!</p>
				<p><a href="https://www.msf.org.br/VoluntarioVirtual/" target="_blank">Página do Voluntário Virtual.</a></p>
			</div>			
		</div>
	</body>
</html>';
					$mail->From = 'no_reply@msf.org.br';
					$mail->FromName = 'Voluntário Virtual';
					$address = "sjmolinski@gmail.com";
					$mail->IsHTML(true);
					$mail->IsSMTP(); // telling the class to use SMTP
					//$mail->Host       = "smtp.msf.org.br"; // SMTP server
					$mail->SMTPAuth   = false;                  // enable SMTP authentication
					//$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
					$mail->Username   = "voluntariovirtual@msf.org.br"; // SMTP account username
					$mail->Password   = "virtu1971";        // SMTP account password

					$mail->Subject    = "MSF - Voluntário Virtual";
					$address = "sjmolinski@gmail.com";
					//$mail->AddAddress($address, 'john doe'); //$_POST['Newsletter_nome']
					$mail->AddAddress($Newsletter['email'], $Newsletter['nome']); //$_POST['Newsletter_nome']

					$mail->Body = $body;
					$s = $mail->Send();	
					if($s) {
						$url .= "EmailSent";
					}

		       } else {
		       		$url = "https://www.msf.org.br/VoluntarioVirtual/?msg=failedToSave"; //&vars=".print_r($_POST['Newsletter']);		    
		       }
		   	}
		} else {
		   //throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		   $url = "https://www.msf.org.br/VoluntarioVirtual/?msg=failed";
		}
		//d($url);
		//Yii::app()->exit();
		$this->redirect($url);
	}


function sendEmail($to, $msg, $subject) {
	 	$baseDomainName = str_replace("www.", "", $_SERVER['HTTP_HOST']);
		$from = "no_reply@".$baseDomainName;
		//$from = "no_reply@cabanapps.com.br";

		//begin of HTML message
		$message = $msg;					

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: MotoRider <'.$from.'>' . "\r\n";

		$sent = mail($to, $subject, $message, $headers);
		if($sent){
			//echo "Email sent.";
			//echo $msg;
		}else{
			//echo "Could not send email.";
		}


	 }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','subscribe'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Newsletter;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Newsletter']))
		{
			$model->attributes=$_POST['Newsletter'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Newsletter']))
		{
			$model->attributes=$_POST['Newsletter'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Newsletter');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Newsletter('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Newsletter']))
			$model->attributes=$_GET['Newsletter'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Newsletter::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='newsletter-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
