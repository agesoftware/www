<?php
    class UserService{
        private $permissionDao = null;
        private $userDao = null;

        public function __construct() {
            $this->permissionDao = new PermissionDao();
            $this->userDao = new UserDao();
        }

        private function restructUser($user) {
            $permission = $this->permissionDao->getPermissionById($user->getPermission());
            $user->setPermission($permission);
            $user->setPassword('<secret>');
        }

        public function retrieveUsers($login, $password) {
            $authenticatedUser = $this->userDao->authenticateUser($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    $users = $this->userDao->retrieveUsers();
                    if($users != null && (count($users) > 0)) {
                        if(get_class($users) != 'ResponseMessage') {
                            foreach($users as &$user) {
                                $this->restructUser($user);
                            }
                            return Jsonify::arrayToJson($users);
                        }
                        else {
                            return $users->serialize();
                        }
                    }
                    else {
                        $message = new ResponseMessage();
                        $message->setMessage('Error: Nenhum usuário encontrado.');
                        $message->setStatus(ResponseMessage::STATUS_ERROR);
        
                        return $message->serialize();
                    }
                }
                else {
                    $message = new ResponseMessage();
                    $message->setMessage('Error: Falha de autenticação.');
                    $message->setStatus(ResponseMessage::STATUS_ERROR);
    
                    return $message->serialize();
                }
            }
            else {
                $message = new ResponseMessage();
                $message->setMessage('Error: Falha de autenticação.');
                $message->setStatus(ResponseMessage::STATUS_ERROR);

                return $message->serialize();
            }
        }

        public function createUser($user, $login, $password) {
            $authenticatedUser = $this->userDao->authenticateUser($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    $dateTime = new DateTime();
                    $now = $dateTime->format('Y-m-d H:i:s');
                    $user->setCreatedAt($now);
                    $user->setUpdatedAt($now);
                    $user->setLastAccess($now);
                    $response = $this->userDao->persistUser($user);
                    return $response->serialize();
                }
                else {
                    $message = new ResponseMessage();
                    $message->setMessage('Error: Falha de autenticação.');
                    $message->setStatus(ResponseMessage::STATUS_ERROR);
    
                    return $message->serialize();
                }
            }
            else {
                $message = new ResponseMessage();
                $message->setMessage('Error: Falha de autenticação.');
                $message->setStatus(ResponseMessage::STATUS_ERROR);

                return $message->serialize();
            }
        }

        private function isAdmin($user) {
            $isAdmin = false;
            $permission = new Permission();
            $permission = $this->permissionDao->getPermissionById($user->getPermission());
            $rules = $permission->getRules();
            $hasAdmRule = strpos($rules, 'Administrador');
            if($hasAdmRule !== false) {
                $isAdmin = true;
            }
            
            return $isAdmin;
        }

        private function canUpdate($user) {
            $canUpdate = false;

            $userToUpdate = $this->userDao->getUserById($user->getId());

            if($this->isAdmin($userToUpdate) && $this->isAdmin($user)) {
                $canUpdate = true;
            }
            else if(!$this->isAdmin($userToUpdate)) {
                $canUpdate = true;
            }
            else {
                $count = 0;
                
                $users = $this->userDao->retrieveUsers();
    
                foreach($users as $user) {
                    if($this->isAdmin($user)) {
                        $count++;
                    }
                }
    
                if($count > 1) {
                    $canUpdate = true;
                }
            }

            return $canUpdate;
        }

        private function canDelete($user) {
            $canDelete = false;

            $user = $this->userDao->getUserById($user->getId());
            
            $count = 0;
            
            $users = $this->userDao->retrieveUsers();

            foreach($users as $user) {
                if($this->isAdmin($user)) {
                    $count++;
                }
            }

            if($count > 1) {
                $canDelete = true;
            }

            return $canDelete;
        }

        public function updateUser($user, $login, $password) {
            $authenticatedUser = $this->userDao->authenticateUser($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    if($this->canUpdate($user)) {
                        $updatedAt = new DateTime();
                        $updatedAtAsString = $updatedAt->format('Y-m-d H:i:s');
                        $user->setUpdatedAt($updatedAtAsString);
                        $response = $this->userDao->updateUser($user);
        
                        return $response->serialize();
                    }
                    else {
                        $message = new ResponseMessage();
                        $message->setMessage('Error: Deve haver ao menos um usuário Administrador.');
                        $message->setStatus(ResponseMessage::STATUS_ERROR);
        
                        return $message->serialize();
                    }
                }
                else {
                    $message = new ResponseMessage();
                    $message->setMessage('Error: Falha de autenticação.');
                    $message->setStatus(ResponseMessage::STATUS_ERROR);
    
                    return $message->serialize();
                }
            }
            else {
                $message = new ResponseMessage();
                $message->setMessage('Error: Falha de autenticação.');
                $message->setStatus(ResponseMessage::STATUS_ERROR);

                return $message->serialize();
            }
        }

        public function deleteUser($user, $login, $password) {
            $authenticatedUser = $this->userDao->authenticateUser($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    if($this->canDelete($user)) {
                        $response = $this->userDao->deleteUser($user);
                        return $response->serialize();
                    }
                    else {
                        $message = new ResponseMessage();
                        $message->setMessage('Error: Deve haver ao menos um usuário Administrador.');
                        $message->setStatus(ResponseMessage::STATUS_ERROR);
        
                        return $message->serialize();
                    }
                }
                else {
                    $message = new ResponseMessage();
                    $message->setMessage('Error: Falha de autenticação.');
                    $message->setStatus(ResponseMessage::STATUS_ERROR);
    
                    return $message->serialize();
                }
            }
            else {
                $message = new ResponseMessage();
                $message->setMessage('Error: Falha de autenticação.');
                $message->setStatus(ResponseMessage::STATUS_ERROR);

                return $message->serialize();
            }
        }

        public function authenticate($login, $password) {
            $found = $this->userDao->authenticateUser($login, $password);
            if($found != null) {
                $className = get_class($found);

                if($className != 'ResponseMessage') {
                    $message = new ResponseMessage();
                    $message->setMessage('Seja bem vindo '.$found->getName());
                    $message->setStatus(ResponseMessage::STATUS_OK);

                    $lastAccess = new DateTime();
                    $lastAccessAsString = $lastAccess->format('Y-m-d H:i:s');
                    $found->setLastAccess($lastAccessAsString);

                    $this->updateUser($found, $login, $password);

                    return $message->serialize();
                }
                else {
                    return $found->serialize();
                }
            }
            else {
                $message = new ResponseMessage();
                $message->setMessage('Erro: Usuário ou senha inválidos.');
                $message->setStatus(ResponseMessage::STATUS_ERROR);
                return $message->serialize();
            }
        }
    }
    
?>