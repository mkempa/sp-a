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

    <div class="row">
        <h3><?php echo __('Assigned genera'); ?></h3>

        <div class="col-md-6">
            <table id="user-assigned-genera" class="table table-bordered table-condensed table-responsive">
                <?php foreach (Hash::get($record, 'Genera') as $g): ?>
                    <tr>
                        <td><?php echo Hash::get($g, 'name'); ?></td>
                        <td></td>
                        <td><?php
                            echo $this->Html->link('Remove >>', array(
                                'action' => 'remove',
                                Hash::get($g, 'UsersGenus.id')
                                    ), array(
                                'class' => 'btn btn-danger btn-xs'
                            ));
                            ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
</div>