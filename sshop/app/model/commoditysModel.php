<?php
namespace app\model;

use core\lib\model;

class commoditysModel extends model
{
    public $table = 'commoditys';
    public $shopcar = 'shopcar';


    public function all()
    {
        return $this->query('SELECT * FROM '.$this->table);
    }

    public function page($page)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." limit 10 OFFSET ? ");
        $sql->bindValue(1, 10*($page-1), \PDO::PARAM_INT);
        $sql->execute();
        return $sql;

    }



    public function getOne($id)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." WHERE `id`= ? ");
        $sql->execute(array($id));
        $res = $sql->fetchAll();

        foreach ($res as $r) {
				return $r;
        }
    }

    public function reduceOne($id)
    {
        $sql = $this->prepare("UPDATE  `".$this->table."` SET amount=amount-1 WHERE `id`=?");
        $ret = $sql->execute(array($id));
        if($ret !== false){
            return true;
        }else{
            return false;
        }
    }

    public function addOne($data)
    {
        $sql = $this->prepare("INSERT INTO ".$this->table."(`name`,`desc`,`amount`,`price`) VALUES (?,?,?,?)");
        return $sql->execute(array($data['name'],$data['desc'],$data['amount'],$data['price']));
        
    }

    public function delOne($id)
    {
        $sql = $this->prepare("DELETE FROM `".$this->table."` WHERE `id`=?");
        $ret = $sql->execute(array($id));
        if($ret !== false){
            return true;
        }else{
            return false;
        }
    }
}