<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP SynonymsController
 * @author Matus
 */
class SynonymsController extends AppController {

    public $uses = array('Synonym');
    
    public $components = array('Input');
    
    public function isAuthorized($user) {
        if ($user['role'] === AUTHOR) {
            $this->set(AUTHORIZED_EDIT, false);
        }
        return true;
    }

    public function totaxonomic($id, $idParent) {
        if (!$id) {
            throw new InvalidArgumentException('SynonymsController::totaxonomic - invalid id');
        }
        $synonym = $this->Synonym->findById($id);
        $synonym['Synonym']['syntype'] = 2;
        $this->Synonym->save($synonym);
        $this->redirect(array('controller' => 'data', 'action' => 'edit', $idParent));
    }

    public function tonomenclatoric($id, $idParent) {
        if (!$id) {
            throw new InvalidArgumentException('SynonymsController::tonomenclatoric - invalid id');
        }
        $synonym = $this->Synonym->findById($id);
        $synonym['Synonym']['syntype'] = 3;
        $this->Synonym->save($synonym);
        $this->redirect(array('controller' => 'data', 'action' => 'edit', $idParent));
    }

    public function remove($id, $idParent) {
        if (!$id) {
            throw new InvalidArgumentException('SynonymsController::remove - invalid id');
        }
        $this->Synonym->delete($id);
        $this->redirect(array('controller' => 'data', 'action' => 'edit', $idParent));
    }

    public function add($type, $idParent) {
        if (!$type) {
            throw new InvalidArgumentException('SynonymsController::add - invalid type');
        }
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (empty($data['synonym'])) {
                throw new InvalidArgumentException('SynonymsController::add - invalid synonym id');
            }
            $synonym = $this->Synonym->create();
            $synonym['Synonym']['id_parent'] = $idParent;
            $synonym['Synonym']['id_synonym'] = $data['synonym'];
            $synonym['Synonym']['syntype'] = $this->Input->syntype($type);
            $synonym['Synonym']['rorder'] = 1;
            $this->Synonym->save($synonym);
        }
        $this->redirect(array('controller' => 'data', 'action' => 'edit', $idParent));
    }
    
}
