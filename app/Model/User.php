<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * CakePHP User
 * @author Matus
 */
class User extends AppModel {

    public $actsAs = array('Containable');
    public $hasAndBelongsToMany = array(
        'Genera' => array(
            'className' => 'Genus',
            'joinTable' => 'users_genera',
            'foreignKey' => 'id_user',
            'associationForeignKey' => 'id_genus',
            'order' => 'Genera.name',
            'unique' => true
        )
    );

    public function beforeSave($options = array()) {
        parent::beforeSave();
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
