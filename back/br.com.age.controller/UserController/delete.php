<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new UserService();

    $user = new User();
    $user->setId(2);
    
    $login = 'Administrador';
    $password = 'admin';

    echo $service->deleteUser($user, $login, $password);
?>