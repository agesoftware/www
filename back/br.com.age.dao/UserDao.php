<?php
    class UserDao extends Dao{
        public function __construct() {
            parent::__construct();
        }

        public function retrieveUsers() {
            $user = new User();
            return parent::retrieve($user);
        }

        public function getUserById($id) {
            $user = new User();
            return parent::getById($id, $user);
        }

        public function authenticateUser($nameOrEmail, $password) {
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

        public function persistUser($user) {
            return parent::persist($user);
        }

        public function updateUser($user) {
            return parent::update($user);
        }

        public function deleteUser($user) {
            return parent::delete($user);
        }
    }
?>