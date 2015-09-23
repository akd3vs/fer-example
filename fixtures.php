<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 23/09/15
 * Time: 01:25 PM
 */

require_once 'includes/Utils.php';

/**
 * @var Utils $utils
 */

$db = $utils->getDB();
$db_config = $utils->getDbConfig();

$db->rawQuery("DROP TABLE IF EXISTS {$db_config['db']}");


$db->rawQuery("
    CREATE TABLE `{$db_config['db']}`.`solicitud`
        (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            `user` VARCHAR(50) NOT NULL ,
            `status` INT(1) NOT NULL DEFAULT '0' ,
            `status_claim` VARCHAR(50) NULL DEFAULT NULL ,
            PRIMARY KEY (`id`)
        )
        ENGINE = InnoDB;
");

$solicitudes = array(
    array(
        'date' => $db->now(),
        'user' => 'Jill',
        'status' => 0
    ),
    array(
        'date' => $db->now(),
        'user' => 'Eve',
        'status' => 1,
        'status_claim' => 'Jesus',
    ),
    array(
        'date' => $db->now(),
        'user' => 'John',
        'status' => 1,
        'status_claim' => 'Jorge'
    )
);

foreach($solicitudes as $key => $solicitud) {
    $id = $db->insert('solicitud', $solicitud);

    if($id) {
        $solicitudes[$key]['id'] = $id;
    } else {
        $utils->reportError($db->getLastError());
    }
}