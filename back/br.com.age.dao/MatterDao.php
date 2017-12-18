<?php
    class MatterDao extends Dao{
        public function __construct() {
            parent::__construct();
        }

        public function retrieveMatters() {
            $matter = new Matter();
            return parent::retrieve($matter);
        }

        public function getMatterById($id) {
            $matter = new Matter();
            return parent::getById($id, $matter);
        }

        public function persistMatter($matter) {
            return parent::persist($matter);
        }

        public function updateMatter($matter) {
            return parent::update($matter);
        }

        public function deleteMatter($matter) {
            return parent::delete($matter);
        }
    }
?>