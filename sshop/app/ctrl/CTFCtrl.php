<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class CTFCtrl extends \core\mypro
{
	public function index()
	{
		$link = mysqli_connect('localhost', 'root', 'root');
		mysqli_select_db($link, 'ciscn');

		$table = addslashes($_POST['table']);
		$sql = "UPDATE `{$table}` 
				SET `username`='admin'
				WHERE id=1";
		if(!mysqli_query($link, $sql)) {
			echo(mysqli_error($link));
		}
		mysqli_close($link);
	}
}