<?php
    class MatterService{
        private $matterDao = null;
        private $permissionDao = null;
        private $userDao = null;

        public function __construct() {
            $this->matterDao = new MatterDao();
            $this->permissionDao = new PermissionDao();
            $this->userDao = new UserDao();
        }

        private function restructMatter($matter) {
            $teacher = $this->userDao->getUserById($matter->getTeacher());
            $teacher = $this->restructUser($teacher);
            $matter->setTeacher($teacher);

            $createdBy = $this->userDao->getUserById($matter->getCreatedBy());
            $createdBy = $this->restructUser($createdBy);
            $matter->setCreatedBy($createdBy);

            $updatedBy = $this->userDao->getUserById($matter->getUpdatedBy());
            $updatedBy = $this->restructUser($updatedBy);
            $matter->setUpdatedBy($updatedBy);

            return $matter;
        }

        private function restructUser($user) {
            $permission = $this->permissionDao->getPermissionById($user->getPermission());
            $user->setPermission($permission);
            $user->setPassword('<secret>');

            return $user;
        }

        public function retrieveMatters($login, $password) {
            $authenticatedUser = $this->userDao->authenticateUser($login, $password);
            if($authenticatedUser != null) {
                if(get_class($authenticatedUser) != 'ResponseMessage') {
                    $matters = $this->matterDao->retrieveMatters();
                    if($matters != null && (count($matters) > 0)) {
                        if(get_class($matters) != 'ResponseMessage') {
                            foreach($matters as &$matter) {
                                $matter = $this->restructMatter($matter);
                            }
                            return Jsonify::arrayToJson($users);
                        }
                        else {
                            return $matters->serialize();
                        }
                    }
                    else {
                        $message = new ResponseMessage();
                        $message->setMessage('Error: Nenhuma matéria cadastrada.');
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

        // public function createUser($user, $login, $password) {
        //     $authenticatedUser = $this->userDao->authenticateUser($login, $password);
        //     if($authenticatedUser != null) {
        //         if(get_class($authenticatedUser) != 'ResponseMessage') {
        //             $dateTime = new DateTime();
        //             $now = $dateTime->format('Y-m-d H:i:s');
        //             $user->setCreatedAt($now);
        //             $user->setUpdatedAt($now);
        //             $user->setLastAccess($now);
        //             $response = $this->userDao->persistUser($user);
        //             return $response->serialize();
        //         }
        //         else {
        //             $message = new ResponseMessage();
        //             $message->setMessage('Error: Falha de autenticação.');
        //             $message->setStatus(ResponseMessage::STATUS_ERROR);
    
        //             return $message->serialize();
        //         }
        //     }
        //     else {
        //         $message = new ResponseMessage();
        //         $message->setMessage('Error: Falha de autenticação.');
        //         $message->setStatus(ResponseMessage::STATUS_ERROR);

        //         return $message->serialize();
        //     }
        // }

        // public function updateUser($user, $login, $password) {
        //     $authenticatedUser = $this->userDao->authenticateUser($login, $password);
        //     if($authenticatedUser != null) {
        //         if(get_class($authenticatedUser) != 'ResponseMessage') {
        //             if($this->canUpdate($user)) {
        //                 $updatedAt = new DateTime();
        //                 $updatedAtAsString = $updatedAt->format('Y-m-d H:i:s');
        //                 $user->setUpdatedAt($updatedAtAsString);
        //                 $response = $this->userDao->updateUser($user);
        
        //                 return $response->serialize();
        //             }
        //             else {
        //                 $message = new ResponseMessage();
        //                 $message->setMessage('Error: Deve haver ao menos um usuário Administrador.');
        //                 $message->setStatus(ResponseMessage::STATUS_ERROR);
        
        //                 return $message->serialize();
        //             }
        //         }
        //         else {
        //             $message = new ResponseMessage();
        //             $message->setMessage('Error: Falha de autenticação.');
        //             $message->setStatus(ResponseMessage::STATUS_ERROR);
    
        //             return $message->serialize();
        //         }
        //     }
        //     else {
        //         $message = new ResponseMessage();
        //         $message->setMessage('Error: Falha de autenticação.');
        //         $message->setStatus(ResponseMessage::STATUS_ERROR);

        //         return $message->serialize();
        //     }
        // }

        // public function deleteUser($user, $login, $password) {
        //     $authenticatedUser = $this->userDao->authenticateUser($login, $password);
        //     if($authenticatedUser != null) {
        //         if(get_class($authenticatedUser) != 'ResponseMessage') {
        //             if($this->canDelete($user)) {
        //                 $response = $this->userDao->deleteUser($user);
        //                 return $response->serialize();
        //             }
        //             else {
        //                 $message = new ResponseMessage();
        //                 $message->setMessage('Error: Deve haver ao menos um usuário Administrador.');
        //                 $message->setStatus(ResponseMessage::STATUS_ERROR);
        
        //                 return $message->serialize();
        //             }
        //         }
        //         else {
        //             $message = new ResponseMessage();
        //             $message->setMessage('Error: Falha de autenticação.');
        //             $message->setStatus(ResponseMessage::STATUS_ERROR);
    
        //             return $message->serialize();
        //         }
        //     }
        //     else {
        //         $message = new ResponseMessage();
        //         $message->setMessage('Error: Falha de autenticação.');
        //         $message->setStatus(ResponseMessage::STATUS_ERROR);

        //         return $message->serialize();
        //     }
        // }

    }
    
?>