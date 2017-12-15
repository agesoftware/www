<?php
    class UserService{
        private $permissionDao = null;
        private $userDao = null;

        public function __construct() {
            $this->permissionDao = new PermissionDao();
            $this->userDao = new UserDao();
        }

        public function retrieveUsers($login, $password) {
            $authenticatedUser = $this->userDao->authenticate($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    $users = $this->userDao->retrieve();
                    if($users != null && (count($users) > 0)) {
                        if(get_class($users) != 'ResponseMessage') {
                            foreach($users as &$user) {
                                $permission = new Permission();
                                $permission = $this->permissionDao->getById($user->getPermission());
                                $user->setPermission($permission);
                                $user->setPassword('<secret>');
                            }
                            return Jsonify::arrayToJson($users);
                        }
                        else {
                            return $user->serialize();
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
            $authenticatedUser = $this->userDao->authenticate($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    $dateTime = new DateTime();
                    $now = $dateTime->format('Y-m-d H:i:s');
                    $user->setCreatedAt($now);
                    $user->setUpdatedAt($now);
                    $user->setLastAccess($now);
                    $response = $this->userDao->persist($user);
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
            $permission = $this->permissionDao->getById($user->getPermission());
            $rules = $permission->getRules();
            $hasAdmRule = strpos($rules, 'Administrador');
            if($hasAdmRule !== false) {
                $isAdmin = true;
            }
            
            return $isAdmin;
        }

        private function canUpdate($user) {
            $canUpdate = false;

            $userToUpdate = $this->userDao->getById($user->getId());

            if($this->isAdmin($userToUpdate) && $this->isAdmin($user)) {
                $canUpdate = true;
            }
            else if(!$this->isAdmin($userToUpdate)) {
                $canUpdate = true;
            }
            else {
                $count = 0;
                
                $users = $this->userDao->retrieve();
    
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

            $user = $this->userDao->getById($user->getId());
            
            $count = 0;
            
            $users = $this->userDao->retrieve();

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
            $authenticatedUser = $this->userDao->authenticate($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    if($this->canUpdate($user)) {
                        $updatedAt = new DateTime();
                        $updatedAtAsString = $updatedAt->format('Y-m-d H:i:s');
                        $user->setUpdatedAt($updatedAtAsString);
                        $response = $this->userDao->update($user);
        
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
            $authenticatedUser = $this->userDao->authenticate($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    if($this->canDelete($user)) {
                        $response = $this->userDao->delete($user);
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
            $found = $this->userDao->authenticate($login, $password);
            $className = get_class($found);
            if($found != null) {
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