<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\captchaModel;

class registerCtrl extends \core\mypro
{

	public function index()
	{
		$captcha = new captchaModel();
		@session_start();
		if(empty($_POST))
		{
			$captcha->init();
			$src = $captcha->src;
			$ques = $captcha->ques;
			$this->assign('src',$src);
			$this->assign('ques',$ques);
			$this->display("register.html");
			exit();
		}

		$captcha_x = post('captcha_x');
		$captcha_y = post('captcha_y');
		$username = post('username');
		$mail = post('mail');
		$password = post('password');
		$password_confirm = post('password_confirm');
		$invite_user = post('invite_user');
		if(!$captcha->check($captcha_x,$captcha_y) || $password!==$password_confirm){
			$captcha->init();
			$src = $captcha->src;
			$ques = $captcha->ques;
			$this->assign('src',$src);
			$this->assign('ques',$ques);
			$this->assign('success',0);
			$this->display("register.html");
			exit();
		}

		$data['username'] = $username;
		$data['password'] = $password;
		$data['mail'] = $mail;
		$data['integral'] = 100;
		$model = new userModel();
		$res = $model->addOne($data);
		if($res){
			$model->addIntegral($invite_user,1000);
			
			jump('/login/');
		}else{
			$captcha->init();
			$src = $captcha->src;
			$ques = $captcha->ques;
			$this->assign('src',$src);
			$this->assign('ques',$ques);
			$this->assign('success',0);
			$this->display("register.html");
			exit();
		}

		
	}




}