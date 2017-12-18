<?php
    class ClassLoader {
        public static function load() {
            require __DIR__ . '/back/br.com.age.models/Permission.php';
            require __DIR__ . '/back/br.com.age.models/User.php';
            require __DIR__ . '/back/br.com.age.models/Matter.php';
        
            require __DIR__ . '/back/br.com.age.dao.utils/DatabaseProps.php';
            require __DIR__ . '/back/br.com.age.dao.utils/Jsonify.php';
            require __DIR__ . '/back/br.com.age.dao.utils/ResponseMessage.php';
            require __DIR__ . '/back/br.com.age.dao.utils/Dao.php';

            require __DIR__ . '/back/br.com.age.dao/PermissionDao.php';
            require __DIR__ . '/back/br.com.age.dao/UserDao.php';
            require __DIR__ . '/back/br.com.age.dao/MatterDao.php';
        
            require __DIR__ . '/back/br.com.age.services/PermissionService.php';
            require __DIR__ . '/back/br.com.age.services/UserService.php';
            require __DIR__ . '/back/br.com.age.services/MatterService.php';
        }
    }
?>