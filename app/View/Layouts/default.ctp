<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));

        echo $this->Html->css('/eip/css/bootstrap-editable');
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('custom');

        echo $this->Html->script('jquery-1.11.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('/eip/js/bootstrap-editable');
        echo $this->Html->script('main');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <?php
        if (AuthComponent::user()) :
            ?>
            <nav class="navbar navbar-default" role="navbar">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <div class="navbar-brand">SlovPlantList Admin</div>
                    </div>
                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="nav navbar-nav">
                            <?php
                            $ctrl = $this->request->params['controller'];
                            $active = ' class="active"';
                            ?>
                            <li<?php echo $ctrl == 'checklist' ? $active : ''; ?>><?php echo $this->Html->link(__('Checklist'), array('controller' => 'data', 'action' => 'index')); ?></li>
                            <li<?php echo $ctrl == 'genera' ? $active : ''; ?>><?php echo $this->Html->link(__('Genera'), array('controller' => 'genera', 'action' => 'index')); ?></li>
                            <li<?php echo $ctrl == 'familiesApg' ? $active : ''; ?>><?php echo $this->Html->link(__('Families APG4'), array('controller' => 'familiesApg', 'action' => 'index')); ?></li>
                            <li<?php echo $ctrl == 'families' ? $active : ''; ?>><?php echo $this->Html->link(__('Families'), array('controller' => 'families', 'action' => 'index')); ?></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($authorizedEdit === true): ?>
                                <li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?></li>
                            <?php endif; ?>
                            <li><?php echo $this->Html->link($logged['name'], array('#')); ?></li>
                            <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Logout', array('controller' => 'authorize', 'action' => 'logout'), array('escape' => false)); ?></li>
                        </ul>
                        <?php
                        if ($this->request->params['controller'] == 'checklist') : //this form is available only for editing data and checklist
                            echo $this->Form->create(false, array('type' => 'get', 'url' => array('action' => 'edit'),
                                'id' => 'editform', 'class' => 'navbar-form navbar-right', 'inputDefaults' => array('label' => false, 'div' => false)));
                            ?>
                            <!--<div class="form-control-static" >Quick search</div>-->
                            <div class="form-group">
                                <?php
                                echo $this->Form->input('id', array('type' => 'text', 'class' => 'form-control'));
                                ?>
                            </div>
                            <?php
                            echo $this->Form->end(array('label' => 'Edit', 'class' => 'btn btn-default', 'div' => false));
                        endif;
                        ?>
                    </div>
                </div>
            </nav>
            <?php
        endif;
        ?>
        <div class="container">
            <div id="flash-messages">
                <?php echo $this->Flash->render(); ?>
            </div>
        </div>
        <?php echo $this->fetch('content'); ?>

        <footer>
            <?php
            //echo $this->element('sql_dump');
            ?>
        </footer>
    </body>
</html>
