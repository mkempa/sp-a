<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP UtilsComponent
 * @author Matus
 */
class UtilsComponent extends Component {

    public $components = array('Auth');

    public function userGenera($UserModel) {
        $authUser = $this->Auth->user();
        $user = $UserModel->findById($authUser);
        return Hash::extract($user, 'Genera.{n}.id');
    }
    
    public function filterRecords($params) {
        $authUser = $this->Auth->user();
        $filterrecordsDefault = $authUser['role'] === AUTHOR ? 'mine' : 'all';
        return isset($params['filterrecords']) ? $params['filterrecords'] : $filterrecordsDefault;
    }

}
