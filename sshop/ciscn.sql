#commoditys table
CREATE TABLE `commoditys`(
    `id` INT(11) unsigned NOT NULL auto_increment,
    `name` VARCHAR(200) NOT NULL DEFAULT '',
    `desc` VARCHAR(500) NOT NULL DEFAULT '',
    `amount` INT(11) unsigned NOT NULL DEFAULT 0,
    `price` FLOAT NOT NULL,
    KEY userid(`id`),
    UNIQUE KEY `name`(`name`) 
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#user table
CREATE TABLE `user`(
    `id` int(11) unsigned NOT NULL auto_increment,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `mail` VARCHAR(50) NOT NULL DEFAULT '',
    `password` VARCHAR(60) NOT NULL DEFAULT '',
    `integral` FLOAT NOT NULL,
    `commodityid` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username`(`username`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#insert

insert into `commoditys` (`id`,`name`,`desc`,`amount`,`price`) values
(3,"flag","asldjalsdjasldjaslkjdlasjdlas",1,10000,
1,"test","haha",3,3.3,
2,"test1","hahah",1,3.2,
);