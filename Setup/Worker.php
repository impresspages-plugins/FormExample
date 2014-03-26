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
        `imageOrder` double,
        `imageName` varchar(255),
        `imageDescription` text,
        `imageFile` varchar(255),
        `personName` varchar(255),
        `email` varchar(255),
        `dateSubmitted` datetime,
        PRIMARY KEY (`id`)
        )';

        ipDb()->execute($sql);
    }

    public function deactivate()
    {
        $sql = 'DROP TABLE IF EXISTS ' . ipTable('formExample');

        ipDb()->execute($sql);
    }

    public function remove()
    {

    }

}
