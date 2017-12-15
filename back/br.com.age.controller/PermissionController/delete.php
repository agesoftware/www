<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new PermissionService();

    $permission = new Permission();
    $permission->setId(2);
    
    $login = 'Administrador';
    $password = 'admin';

    echo $service->deletePermission($permission, $login, $password);
?>