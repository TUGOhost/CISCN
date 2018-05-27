<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class shopcarCtrl extends \core\mypro
{

    public function index()
	{
		if(!loggedin()){
			jump('/login/');
		}
		if(empty($_SESSION)){
			session_start();
		}
		$user = $_SESSION['user'];
		$price = post('price'); 
		if($price){
			$userid = $_SESSION['user']['id'];
			$usermodel = new userModel();
			if($usermodel->pay($user['id'],$price)){
				    $_SESSION['user'] = $usermodel->getById($user['id']);//更新session
					$this->assign('success',1);
					$this->assign('user',$user);
					$this->display('shopcar.html');
					exit();
			}
		}
		if(empty($_POST)){
			$usermodel = new userModel();
			$commoditymodel = new commoditysModel();
			$commodityid = $usermodel->getById($user['id'])['commodityid'];
			$shopcar = $commoditymodel->getOne($commodityid);
			$this->assign('shopcar',$shopcar);
			$this->assign('user',$user);
			$this->display('shopcar.html');
			exit();

		}

		$commodityid = post('commodityid');
        if($commodityid){
            
            $usermodel = new userModel();
            $userMoney = $usermodel->getById($user['id'])['integral'];
            $commoditymodel = new commoditysModel();
            $commodity = $commoditymodel->getOne($commodityid);
            $commodityprice = $commodity['price'];
            $commodityamount = $commodity['amount'];

            if($commodityamount>=1 && $userMoney>=$commodityprice){
                if($commoditymodel->reduceOne($commodityid) && $usermodel->pay($user['id'],$commodityprice))
                {
                    $_SESSION['user'] = $usermodel->getById($user['id']);
                    $this->assign('success',1);
                    $this->display('pay.html');

                }else{
                $this->assign('success',0);
                $this->display('pay.html');
                }
            }else{
                $this->assign('success',0);
                $this->display('pay.html');
            }

        }
		



    }
    
    public function add()
	{
		if(!loggedin()){
			jump('/login/');
		}
		if(empty($_SESSION)){
			session_start();
		}



		$commodityid = post('id',0,'int');
		$userid = $_SESSION['user']['id'];
		$model = new userModel();
		if($model->addCommodity($userid,$commodityid)){
			jump('/shopcar/');
		}else{
			dp("add error");
		}



	}


}