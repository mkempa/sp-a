<div class="container">
    <h2><?php echo __('New genus'); ?></h2>
    <?php
    echo $this->Form->create('Genus', array('type' => 'post', 'url' => array('controller' => 'genera', 'action' => 'add'),
        'id' => 'GenusAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
    ?>
    <div class="form-group">
        <?php
        echo $this->Form->label('name');
        echo $this->Form->input('name', array('class' => 'form-control', 'required' => true));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('authors');
        echo $this->Form->input('authors', array('class' => 'form-control'));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('vernacular');
        echo $this->Form->input('vernacular', array('class' => 'form-control'));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('id_family_apg', 'Family APG4');
        echo $this->Form->input('id_family_apg', array('class' => 'form-control', 'options' => $familiesApg, 'empty' => true));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('id_family', 'Family');
        echo $this->Form->input('id_family', array('class' => 'form-control', 'options' => $families, 'empty' => true));
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
            echo $this->Html->link(__('Cancel'), '/genera/index', array(
                'class' => 'btn btn-default'
            ));
            ?>
        </div>
    </div>

    <?php
    echo $this->Form->end();
    ?>
</div>