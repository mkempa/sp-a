<?php
//new dBug($record);

$assignedGenera = Hash::extract($record, 'Genera.{n}.id');
$unassignedGenera = array_diff_key($genera, array_flip($assignedGenera));

$roles = array(ADMIN, EDITOR, AUTHOR);
?>
<div id="user-detail" class="container">
    <h3><?php echo Hash::get($record, 'User.username'); ?></h3>

    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Name'); ?></td>
            <td><?php echo $this->Edit->eipInput($record, 'User.name'); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Role'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($record, 'User.role', array(
                    'type' => 'select',
                    'source' => $roles
                ));
                ?></td>
        </tr>
    </table>

    <h3><?php echo __('Assigned genera'); ?></h3>
    <div class="row">
        <div class="col-md-6">
            <?php
            echo $this->Form->create(false, array('type' => 'post', 'url' => array(
                    'controller' => 'users', 'action' => 'remove', Hash::get($record, 'User.id')),
                'id' => 'user-remove-genera-form',
                'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
            ?>
            <table id="user-assigned-genera" class="table table-bordered table-condensed table-responsive">
                <?php if (empty(Hash::get($record, 'Genera'))): ?>
                    <tr>
                        <td></td>
                    </tr>
                    <?php
                endif;
                $i = 0;
                foreach (Hash::get($record, 'Genera') as $g):
                    $usersgeneraElId = $i . '-usersgenera-id';
                    ?>
                    <tr>
                        <td><?php echo Hash::get($g, 'name'); ?></td>
                        <td><?php
                            echo $this->Form->checkbox('UsersGenera.ids.', array(
                                'id' => $usersgeneraElId,
                                'multiple' => 'checkbox',
                                'value' => Hash::get($g, 'UsersGenus.id'),
                                'hiddenField' => false));
                            ?></td>
                        <td><?php
                            echo $this->Form->submit('Remove >>', array(
                                'class' => 'btn btn-danger btn-xs user-remove-genera-btn',
                                'data-id-usersgenus' => Hash::get($g, 'UsersGenus.id'),
                                'data-id-usersgenera-el' => $usersgeneraElId
                            ));
                            ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </table>
            <?php
            echo $this->Form->submit('Remove selected', array(
                'id' => 'user-remove-selected-genera-btn pull-right',
                'class' => 'btn btn-danger'
            ));
            echo $this->Form->end();
            ?>
        </div>
        <?php
        echo $this->Form->create('UsersGenera', array('type' => 'post', 'url' => array(
                'controller' => 'users', 'action' => 'addgenera', Hash::get($record, 'User.id')),
            'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
        ?>

        <div class="col-md-2 text-center">
            <?php
            echo $this->Form->submit('<< Add', array('id' => 'user-add-genera-btn',
                'class' => 'btn btn-success'));
            ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $this->Form->input('Genera', array(
                'id' => 'user-add-genera-list',
                'multiple' => 'multiple',
                'type' => 'select',
                'options' => $unassignedGenera,
                'div' => false,
                'label' => false
            ));
            ?>
        </div>
        <?php $this->Form->end(); ?>
    </div>
</div>