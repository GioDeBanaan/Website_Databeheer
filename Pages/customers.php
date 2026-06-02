<?php
    require_once __DIR__ . "/../Controller/customersController.php";

<<<<<<< HEAD
$controller = new CustomersController();
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        if ($id === null) {
            die("Missing customer id");
        }
        $controller->edit($id);
        break;
    case 'update':
        if ($id === null) {
            die("Missing customer id");
        }
        $controller->update($id);
        break;
    default:
        $controller->index();
        break;
}
=======
    $controller = new CustomersController();
    $controller->index();
>>>>>>> b4f6cf5b199b755242295d6d163ce28ce40d00e1
?>
