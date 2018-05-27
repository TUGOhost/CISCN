<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class changeCtrl extends \core\mypro
{
	public function index()
	{
		$length = 32;
		$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if(!is_int($length)||$length<0){
			return false;
		}
		do{
		$flag = '';
		for($i=$length;$i>0;$i--){
			$flag.=$char[mt_rand(0,strlen($char)-1)];
		}
		//eval $flag;
		$intervall = 60*30;
		
		
			$flagfile = fopen("flag.txt","w");
			fwrite($flagfile,$file);
			sleep($intervall);
		}while(true);
	}
	
	/*public function make_flag($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		/*$cahrs = array_rand('a','b','c','d','e','f','g','h',
		'i','j','k','k','l','m','n','o',p','q','r','s',
		't','u','v','w','x','y','z','A','B','C','D',
		'E','F','G','H','I','J','K','L','M','N','O',
		'P','Q','R','S','T',U','V','W','X','Y','Z',
		'0','1','2','3','4','5','6','7','8','9');%keys = ($chars,$length);
		$flag = '';
		for($i = 0;$i <$length;$i++)
		{
		$flag.=$cahrs[$keys[$i]];
		}
		return $flag;*/
	
		
		
		/*$cahrs = array_rand('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 
'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's', 
't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D', 
'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 
'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z', 
'0′, '1', '2′, '3', '4′, '5', '6', '7', '8′, '9', '!', 
'@','#', '$', '%', '^', '&', '*', '(', ')', '-', '_', 
'[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',', 
'.', ';', ':', '/', '?', '|'); 
		if(!is_int($length)||$length<0){
			return false;
		}
		$flag = '';
		for($i=$length;$i>0;$i--){
			$flag.=$char[md_rand(0,strlen($char)-1)];
		}
		return $flag;
		
	}*/
}