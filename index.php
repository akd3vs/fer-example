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

$entries = $db->get('solicitud');
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
            <td><a href="/solicitud?id=<?= $entry['id']; ?>"</td>
            <td><?= ($entry['status']) ? 'Autorizado por: ' . $entry['status_claim'] : 'Pendiente'; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>