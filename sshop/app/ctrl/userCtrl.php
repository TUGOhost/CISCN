<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\captchaModel;


class userCtrl extends \core\mypro
{
   	public function index()
	{
		if(!loggedin()){
			jump('/login/');
		}else{
			$id = $_SESSION['user']['id'];
			$model = new userModel();
			$_SESSION['user'] = $model->getById($id);
			$user = $_SESSION['user'];
			$this->assign('user',$user);
			$this->display('user.html');
		}
		
	}
    public function change()
    {
		if(!isset($_SESSION)){
			session_start();
		}
		if(!loggedin()){
			jump('/login/');
		}
		if(empty($_POST))
		{
			$this->assign('user',$_SESSION['user']);
			$this->display('change.html');
			exit();
		}
		$old_password = post('old_password');
		$password = post('password');
		$password_confirm = post('password_confirm');
		$model = new userModel();
		$user = $_SESSION['user'];

		$data['username'] = $user['username'];
		$data['password'] = $old_password;
		if($password!==$password_confirm || !$model->getOne($data)){
			$this->assign('success',0);
			$this->display("change.html");
			exit();
		}else{
			$data['id'] = $user['id'];
			$data['password'] = $password;
			if($model->setPass($data)){
				$data['username'] = $user['username'];
				$data['password'] = $password;
				$_SESSION['user'] = $model->getOne($data);
				$this->assign('success',1);
				$this->display("change.html");
				exit();
			}else{
				$this->assign('success',0);
				$this->display("change.html");
				exit();
			}

		}
		

    }


}