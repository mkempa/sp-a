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

    public $uses = array('Genus', 'User', 'UsersGenera');
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

    public function detail($id) {
        if (empty($id)) {
            throw new InvalidArgumentException('Id must not be empty!');
        }
        $record = $this->User->findById($id);
        $genera = $this->Genus->listGenera();
        $this->set(compact('genera', 'record'));
    }
    
    public function remove($genera = null) {
        if ($genera == null) {
            //get array of genera
        }
        $this->UsersGenera->delete(array('UsersGenera.id' => $genera), false);
        $this->redirect(array('action' => 'detail'));
    }
    
    private function _add() {
        $user['User'] = array('username' => 'author', 'password' => 'auth', 'name' => 'Author', 'role' => AUTHOR);
        $this->User->save($user);
    }
    
}
 