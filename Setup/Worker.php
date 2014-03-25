<?php

namespace Plugin\FormExample\Setup;

class Worker extends \Ip\SetupWorker
{

    public function activate()
    {
        $sql = '
        CREATE TABLE IF NOT EXISTS
           ' . ipTable('formExample') . '
        (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `enabled` boolean,
        `productOrder` double,
        `productName` varchar(255),
        `productDescription` text,
        `imageFile` varchar(255),
        `personName` varchar(255),
        `phone` varchar(255) ,
        `hidePhone` boolean,
        `email` varchar(255),
        `dateSubmitted` datetime,
        PRIMARY KEY (`id`)
        )';

        ipDb()->execute($sql);
    }

    public function deactivate()
    {

    }

    public function remove()
    {

    }

}
