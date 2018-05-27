<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class shopCtrl extends \core\mypro
{

    public function index()
	{
		$page = get('page',1,'int');
		$model = new commoditysModel();
		$commoditys = $model->page($page);
		$this->assign('commoditys',$commoditys);
		$this->assign('page',$page);
		$this->display('shop.html');
	}
}