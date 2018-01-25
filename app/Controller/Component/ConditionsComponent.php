<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ConditionsComponent
 * @author Matus
 */
class ConditionsComponent extends Component {

    public function viewFilter($type, $ids) {
        if ($type === 'mine') {
            return array('Nomenclature.id_genus' => $ids);
        }
        return array();
    }

}
