<?php

include_once "app/controllers/section.controller.php";
include_once "app/controllers/product.controller.php";
include_once "app/controllers/categorie.controller.php";
include_once "app/controllers/auth.controller.php";
require_once('libs/Smarty.class.php');

$sectionController = new SectionController;
$productController = new ProductController;
$categorieController = new CategorieController;



define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');


// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home'; // acción por defecto si no envían
}


$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'login':
        $authController = new authController;
        $authController->showLoginForm();
        break;
    case 'checkLog':
        $authController = new authController;
        $authController->checkLog();
        break;
    case 'checkRegister':
        $authController = new authController;
        $authController->checkRegister();
        break;
    case 'logout':
        $authController = new authController;
        $authController->logout();
        break;


    case 'home': 
        $sectionController->Home(); 
        break;
    case 'men':
        $sectionController->menSection(); 
        break;
    case 'women':
        $sectionController->womenSection(); 
        break;
    case 'store': 
        if(isset($params[2])) $sectionController->Store($params[1], $params[2]); 
        elseif(isset($params[1])) $sectionController->Store($params[1]);
        else $sectionController->Store();
        break;


    case 'getLoad':
        $productController->showProductForm("Cargar producto", "load", $params[1] = null);
        break;
    case 'load':
        $productController->insertProduct();
        break;
    case 'getEdit':
        $productController->showProductForm("Cargar producto", "edit/$params[1]", $params[1]);
        break;
    case 'edit':
        $productController->editProduct($params[1]);
        break;
    case 'delete':
        $productController->deleteProduct($params[1]);
        break;
    case 'show':
        $productController->showItem($params[1]);
        break;

        
    case 'newCategorie':
        $categorieController->showCategorieForm("addCategorie");
        break;
    case 'addCategorie':
        $categorieController->addCategorie();
        break;
    case 'categorias':
        $categorieController->showCategorieList();
        break;
    case 'editCategorie':
        $categorieController->showCategorieForm("updateCategorie/$params[1]", $params[1]);
        break;
    case 'updateCategorie':
        $categorieController->updateCategorie($params[1]);
        break;
    case 'deleteCategorie':
        $categorieController->deleteCategorie($params[1]);
        break;
    default: 
        echo('404 Page not found'); 
        break;
}