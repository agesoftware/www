<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new PermissionService();

    $permission = new Permission();
    $permission->setId(2);
    $permission->setDescription('Teste');
    $permission->setRules('Administrador');
    
    $login = 'Administrador';
    $password = 'admin';

    echo $service->updatePermission($permission, $login, $password);
?>