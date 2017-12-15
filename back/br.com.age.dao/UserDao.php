<?php
    class UserDao extends Dao{
        public function __construct() {
            parent::__construct();
        }

        public function retrieve() {
            $user = new User();
            return parent::retrieve($user);
        }

        public function getById($id) {
            $user = new User();
            return parent::getById($id, $user);
        }

        public function authenticate($nameOrEmail, $password) {
            try {
                $object = new User();
                $object->setName($nameOrEmail);
                $object->setPassword($password);
                $class = get_class($object);
                $entity = $object->entityName();
                
                $connection = $this->conn;
                if($connection != null) {
                    $statement = $connection->prepare('SELECT * FROM '.strtolower($entity).' WHERE (name = :name or email = :email) and password = :password');
                    $statement->bindParam(':name',$object->getName());
                    $statement->bindParam(':email',$object->getName());
                    $statement->bindParam(':password',$object->getPassword());
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_CLASS, $class);
                    $found = $statement->fetch();
                    return $found;
                }
                else {
                    return $this->message;
                }
            } catch(Exception $e) {
                $mensagem = $this->message;
                $mensagem->setMessage('Error: '.$e->getMessage());
                $mensagem->setStatus(ResponseMessage::STATUS_ERROR);
                return $mensagem;
            }
        }

        public function persist($user) {
            return parent::persist($user);
        }

        public function update($user) {
            return parent::update($user);
        }

        public function delete($user) {
            return parent::delete($user);
        }
    }
?>