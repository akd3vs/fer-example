<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 23/09/15
 * Time: 01:18 PM
 */

require_once 'includes/Utils.php';

/**
 * @var Utils $utils
 */

$db = $utils->getDB();

try {
    $entries = $db->get('solicitud');
} catch (\Exception $e) {
    $entries = [];
}

if(empty($entries)) {
    echo '<p>No hay datos en la base de datos, ingresa a <a href="/fixtures.php">Fixtures</a> para ingresar datos de prueba. No te olvides de configurar includes/config.php</p>';
}
?>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Solicitud</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($entries as $entry): ?>
        <tr>
            <td><?= $entry['id']; ?></td>
            <td><?= $entry['date']; ?></td>
            <td><?= $entry['user']; ?></td>
            <td><a href="/solicitud.php?id=<?= $entry['id']; ?>">Ver</a></td>
            <td><?= ($entry['status']) ? 'Autorizado por: ' . $entry['status_claim'] : 'Pendiente'; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>