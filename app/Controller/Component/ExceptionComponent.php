<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ExceptionComponent
 * @author Matus
 */
class ExceptionComponent extends Component {
    
    public $components = array('Flash');

    public function handlePDOException(PDOException $e, $field, $value) {
        $field = strtolower($field);
        $message = '';
        switch ($e->getCode()) {
            case 23000:
                $message = ucfirst($field) . " with value '$value' already exists in database. Please choose another $field";
                break;
            default:
                break;
        }
        $this->Flash->error($message);
    }

}
