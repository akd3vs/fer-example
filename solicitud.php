<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 23/09/15
 * Time: 01:55 PM
 */

require_once 'includes/Utils.php';

/**
 * @var Utils $utils
 */

$db = $utils->getDB();

$id = $utils->cleanInput($_GET['id']);

if(isset($_GET['action'])) {
    $action = $utils->cleanInput($_GET['action']);

    switch ($action) {
        case 'authorize':
            $db->where('id', $id);
            $status = $db->update('solicitud', array(
                'status' => 1,
                'status_claim' => 'Admin' // Aqui podrias poner $utils->getCurrentUser(); y obtines el usuario de la sesion o algo
            ));
            if(!$status) {
                $utils->addError('No se pudo actualizar el estado de la solicitud. Intentelo mas tarde.');
            }
            break;
    }
}

$db->where('id', $id);

$solicitud = $db->get('solicitud');
$solicitud = $solicitud[0];

$utils->showErrors();
?>

<p>
    ID: <?= $solicitud['id']; ?>
</p>
<p>
    Fecha: <?= $solicitud['date']; ?>
</p>
<p>
    Usuario: <?= $solicitud['user']; ?>
</p>
<p>
    Estatus: <?= ($solicitud['status']) ? 'Autorizado por: ' . $solicitud['status_claim'] : "<a href=\"/solicitud.php?id={$solicitud['id']}&action=authorize\">Da click aqu&iacute; para autorizar</a>"; ?>
</p>
