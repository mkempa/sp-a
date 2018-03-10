<?php

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class AuthorizeController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login');
    }
    
    public function isAuthorized($user) {
        return true;
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

}
