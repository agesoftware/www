<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new PermissionService();

    $login = $_POST['login'];
    $password = $_POST['password'];

    echo $service->retrievePermissions($login, $password);
?>