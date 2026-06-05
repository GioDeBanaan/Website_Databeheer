<?php
require_once __DIR__ . '/../Controller/transactionsController.php';

$controller = new TransactionsController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->edit($id);
        break;
    case 'update':
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->update($id);
        break;
    case 'delete':
        if ($id === null) {
            die("Missing transaction id");
        }
        $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}
?>
