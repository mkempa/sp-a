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

    public function remove($idUser) {
        if ($this->request->is('post')) {
            if ($idUser == null) {
                throw new InvalidArgumentException("IdUser must not be null!");
            }
            $data = $this->request->data;
            $idsToRemove = array_filter($data['UsersGenera']['ids']);
            $this->UsersGenera->deleteAll(array('UsersGenera.id' => $idsToRemove), false);
            $this->redirect(array('action' => 'detail', $idUser));
        }
    }

    public function addgenera($idUser) {
        if ($this->request->is('post')) {
            if ($idUser == null) {
                throw new InvalidArgumentException("IdUser must not be null!");
            }
            $data = $this->request->data;
            $newEntities = array();
            foreach ($data['UsersGenera']['Genera'] as $d) {
                $userGenera = array('UsersGenera' => array('id_user' => $idUser));
                $userGenera['UsersGenera']['id_genus'] = $d;
                $newEntities[] = $userGenera;
            }
            $this->UsersGenera->saveAll($newEntities);
            $this->redirect(array('action' => 'detail', $idUser));
        }
    }

    private function _add() {
        $user['User'] = array('username' => 'author', 'password' => 'auth', 'name' => 'Author', 'role' => AUTHOR);
        $this->User->save($user);
    }

}
