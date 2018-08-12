<?php

//die('slider module setup');

$installer = $this;
$installer->startSetup();
$installer->run("
    DROP TABLE IF EXISTS sliders;
    CREATE TABLE sliders (
        `slider_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `slider_name` VARCHAR(255) NOT NULL,
        `slider_status` smallint(6) NOT NULL default '0',

        PRIMARY KEY (`slider_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    DROP TABLE IF EXISTS slides;
    CREATE TABLE slides (
    `slide_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `slide_title` VARCHAR(255) NOT NULL,
    `slide_discription` TEXT NOT NULL,
    `slide_image` VARCHAR(255) NOT NULL,
    `slide_status` smallint(6) NOT NULL default '0',
    `slider_id` INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (slide_id),
    FOREIGN KEY (slider_id) REFERENCES sliders(slider_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8; 
    
");

$installer->endSetup();