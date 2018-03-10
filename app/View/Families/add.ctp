<div class="container">
    <h2><?php echo __('New family'); ?></h2>
    <?php
    echo $this->Form->create('Family', array('type' => 'post', 'url' => array('controller' => 'families', 'action' => 'add'),
        'id' => 'FamilyAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
    ?>
    <div class="form-group">
        <?php
        echo $this->Form->label('name');
        echo $this->Form->input('name', array('class' => 'form-control', 'required' => true));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('vernacular');
        echo $this->Form->input('vernacular', array('class' => 'form-control'));
        ?>
    </div>

    <div class="row submit-panel">
        <div class="col-md-1 col-xs-6">
            <?php
            echo $this->Form->submit('Save', array(
                'class' => 'btn btn-primary'
            ));
            ?>
        </div>
        <div class="col-md-1 col-xs-6">
            <?php
            echo $this->Html->link(__('Cancel'), '/families/index', array(
                'class' => 'btn btn-default'
            ));
            ?>
        </div>
    </div>

    <?php
    echo $this->Form->end();
    ?>
</div>