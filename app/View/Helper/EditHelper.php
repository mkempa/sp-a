<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP EditHelper
 * @author Matus
 */
class EditHelper extends AppHelper {

    public $helpers = array('Eip.Eip');

    public function eipInput($data, $path, $options = array()) {
        $defaults = array(
            'editable' => true,
            'isBool' => false
        );
        $options = array_merge($defaults, (array) $options);
        if (!$options['editable']) {
            if (isset($options['display'])) {
                return $options['display'];
            }
            return $this->_string(Hash::get($data, $path));
        }
        if ($options['isBool'] === true) {
            return $this->Eip->inputBool($path, $data, $options['valTrue'], $options['valFalse']);
        }
        //get rid of custom options
        $this->_unsetAll($options, array_keys($defaults));
        return $this->Eip->input($path, $data, $options);
    }
    
    private function _string($val) {
        if ($val === false) {
            return 'False';
        }
        return $val;
    }
    
    private function _unsetAll($array, $keys) {
        foreach ($keys as $k) {
            unset($array[$k]);
        }
    }
    
}
