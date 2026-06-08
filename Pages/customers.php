<!-- 08/06/2026 made by Kai Hiraki -->
<?php
    require_once __DIR__ . "/../Controller/customersController.php";
    
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
?>
