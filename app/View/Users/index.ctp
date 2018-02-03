<?php
new dBug($users);

$roles = array(ADMIN, EDITOR, AUTHOR);
?>

<div class="container-fluid">
    <h2><?php echo __('Users'); ?></h2>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th>ID</th>
                <th><?php echo __('Action'); ?></th>
                <th><?php echo __('Username'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Role'); ?></th>
            </tr>

            <?php foreach ($users as $u) : ?>
                <tr>
                    <td><?php echo Hash::get($u, 'User.id'); ?></td>
                    <td><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $u['User']['id']), array('title' => __('Edit'))); ?></td>
                    <td><?php echo Hash::get($u, 'User.username'); ?></td>
                    <td><?php echo $this->Edit->eipInput($u, 'User.name'); ?></td>
                    <td><?php
                        echo $this->Edit->eipInput($u, 'User.role', array(
                            'type' => 'select',
                            'source' => $roles
                        ));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>