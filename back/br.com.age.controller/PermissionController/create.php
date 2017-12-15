<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new PermissionService();

    $permission = new Permission();
    $permission->setId(null);
    $permission->setDescription('Teste');
    $permission->setRules('Teste');

    $login = 'Administrador';
    $password = 'admin';

    echo $service->createPermission($permission, $login, $password);
?>