<?php ?>

<div class="container-fluid">
    <h2><?php echo __('Edit Family'); ?></h2>
    <div id="table-container">
        <?php
        $backRecord = !empty($this->request->params['named']['record']) ? $this->request->params['named']['record'] : '';
        if (!empty($this->request->params['named']['genus'])) {
            echo $this->Html->link('<< Back', array(
                'controller' => 'genera',
                'action' => 'detail',
                $this->request->params['named']['genus'],
                'record' => $backRecord
                    ), array('class' => 'btn btn-primary'));
        }
        ?>
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th class="col-xs-1"><?php echo __('ID'); ?></th>
                <th class="col-xs-5"><?php echo __('Name'); ?></th>
                <th class="col-xs-5"><?php echo __('Vernacular'); ?></th>
            </tr>
            <tr>
                <td><?php echo Hash::get($result, 'Family.id'); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'Family.name', array('editable' => $authorizedEdit)); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'Family.vernacular', array('editable' => $authorizedEdit)); ?></td>
            </tr>
        </table>
    </div>
</div>