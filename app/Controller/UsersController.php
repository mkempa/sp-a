<?php

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add');
    }

    public function login() {
        if ($this->request->is('post')) {
            // Important: Use login() without arguments! See warning below.
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /*
     * Admin = tester, test
     * Editor = editor, edit
     * Author = author, auth
     */
    public function add() {
        $user['User'] = array('username' => 'author', 'password' => 'auth', 'name' => 'Author', 'role' => AUTHOR);
        $this->User->save($user);
    }

}
