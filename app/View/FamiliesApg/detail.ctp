<div class="container-fluid">
    <h2><?php echo __('Edit Family APG'); ?></h2>
    <div id="functions-bar" class="row">
        <div class="col-md-1">
            <?php
            $backRecord = !empty($this->request->params['named']['record']) ? $this->request->params['named']['record'] : '';
            $backUrl = array('controller' => 'genera', 'action' => 'index');
            if (!empty($this->request->params['named']['genus'])) {
                $backUrl = array(
                    'controller' => 'genera',
                    'action' => 'detail',
                    $this->request->params['named']['genus'],
                    'record' => $backRecord
                );
            }
            echo $this->Html->link('<< Back', $backUrl, array('class' => 'btn btn-primary'));
            ?>
        </div>
        <div class="col-md-1">
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-chevron-up"></span> View all families', '/familiesApg/index', array('class' => 'btn btn-default', 'escape' => false)); ?>
        </div>
    </div>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th class="col-xs-1"><?php echo __('ID'); ?></th>
                <th class="col-xs-5"><?php echo __('Name'); ?></th>
                <th class="col-xs-5"><?php echo __('Vernacular'); ?></th>
            </tr>
            <tr>
                <td><?php echo Hash::get($result, 'FamilyApg.id'); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'FamilyApg.name', array('editable' => $authorizedEdit)); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'FamilyApg.vernacular', array('editable' => $authorizedEdit)); ?></td>
            </tr>
        </table>
    </div>
</div>
