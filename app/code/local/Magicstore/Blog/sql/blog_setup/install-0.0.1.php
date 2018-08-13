<?php

//die('blog module setup');

$installer = $this;
$installer->startSetup();
$installer->run("
    DROP TABLE IF EXISTS magicstore_category;
    CREATE TABLE magicstore_category (
        `category_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `category_name` VARCHAR(255) NOT NULL,
        `category_description` TEXT NOT NULL,
        `category_image` VARCHAR(255) NOT NULL,

        PRIMARY KEY (`category_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    DROP TABLE IF EXISTS magicstore_post;
    CREATE TABLE magicstore_post (
    `post_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `post_name` VARCHAR(255) NOT NULL,
    `post_discription` VARCHAR(255) NOT NULL,
    `post_content` TEXT NOT NULL,
    `post_status` smallint(6) NOT NULL default '0',
    `post_created` DATETIME,
    `post_updated` DATETIME,
    `category_id` INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (post_id),
    FOREIGN KEY (category_id) REFERENCES magicstore_category (category_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8; 
    
");

$installer->endSetup();