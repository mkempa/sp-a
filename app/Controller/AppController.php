<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('dBug', 'dBug');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
        'Flash',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'authorize',
                'action' => 'login'
            ),
            'loginRedirect' => array(
                'controller' => 'data',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'authorize',
                'action' => 'login'
            ),
            'authError' => 'You are not authorized to see that',
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
        $this->set('logged', $this->Auth->user());
        $this->set(AUTHORIZED_EDIT, true);
    }
    
    public function isAuthorized($user) {
        // Admin can access every action
        if (empty($user['role'])) {
            throw new InvalidArgumentException('User role is not set!');
        }
        if ($user['role'] == ADMIN) {
            return true;
        }
        // Default deny
        $this->Flash->error('Your are not authorized to do this action!');
        return false;
    }
    
}
