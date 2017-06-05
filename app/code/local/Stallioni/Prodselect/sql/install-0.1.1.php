<?php

$installer = $this;

$installer->startSetup();

$installer->run("DROP TABLE IF EXISTS {$this->getTable('vendorpage')};
CREATE TABLE {$this->getTable('vendorpage')} (
  `vendorpage_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) unsigned NOT NULL DEFAULT '',
  `vendor_name` varchar(255) NOT NULL DEFAULT '',
  `vendorlogo` text NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`vendorpage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
");

$installer->endSetup(); 
