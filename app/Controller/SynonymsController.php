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

    public function remove($id) {
        if (!$id) {
            throw new InvalidArgumentException('SynonymsController::remove - invalid id');
        }
    }

}
