<?php
    require('../../../classloader.php');
    header('Content-type: application/json; charset=UTF-8');

    ClassLoader::load();
    
    $service = new UserService();

    $user = new User();
    $user->setId(1);
    $user->setName('Administrador');
    $user->setPassword('admin');
    $user->setPhone1('81996729491');
    $user->setPhone2('81988874815');
    $user->setEmail('douglasf.filho@gmail.com');
    $user->setPermission(1);
    
    $createdAt = new DateTime('2017-12-12 15:57:51');
    $createdAtAsString = $createdAt->format('Y-m-d H:i:s');
    $user->setCreatedAt($createdAtAsString);
    
    $lastAccess = new DateTime('2017-12-12 15:57:51');
    $lastAccessAsString = $lastAccess->format('Y-m-d H:i:s');
    $user->setLastAccess($lastAccessAsString);

    $login = 'Administrador';
    $password = 'admin';

    echo $service->updateUser($user, $login, $password);
?>