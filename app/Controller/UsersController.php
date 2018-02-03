<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author Matus
 */
class UsersController extends AppController {

    public $uses = array('User');
    public $helpers = array(
        'Eip.Eip',
        'Edit'
    );
    public $components = array(
        'Eip.Eip'
    );
    
    public function isAuthorized($user) {
        return $user['role'] === ADMIN;
    }
    
    public function index() {
        $this->User->recursive = -1;
        $users = $this->User->find('all');
        $this->set(compact('users'));
    }

    private function _add() {
        $user['User'] = array('username' => 'author', 'password' => 'auth', 'name' => 'Author', 'role' => AUTHOR);
        $this->User->save($user);
    }
    
}
