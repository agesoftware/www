<?php
    class PermissionDao extends Dao{
        public function __construct() {
            parent::__construct();
        }

        public function retrieve() {
            $permission = new Permission();
            return parent::retrieve($permission);
        }

        public function getById($id) {
            $permission = new Permission();
            return parent::getById($id, $permission);
        }

        public function persist($permission) {
            return parent::persist($permission);
        }

        public function update($permission) {
            return parent::update($permission);
        }

        public function delete($permission) {
            return parent::delete($permission);
        }
    }
?>