
<div class="container">
    <h2><?php echo __('New user'); ?></h2>
    <?php
    echo $this->Form->create('User', array('type' => 'post', 'url' => array('controller' => 'users', 'action' => 'add'),
        'id' => 'UserAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
    ?>
    <div class="form-group">
        <?php
        echo $this->Form->label('username');
        echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Login', 'required' => true));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('name');
        echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Real name'));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('email');
        echo $this->Form->input('email', array('type' => 'email', 'class' => 'form-control'));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->label('password');
        echo $this->Form->input('password', array('type' => 'text', 'class' => 'form-control', 'required' => true));
        ?>
    </div>
    <div class="form-group">
        <?php
        $roles = array(ADMIN => ADMIN, EDITOR => EDITOR, AUTHOR => AUTHOR);
        echo $this->Form->label('role');
        echo $this->Form->input('role', array('class' => 'form-control', 'options' => $roles));
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
            echo $this->Html->link(__('Cancel'), '/users/index', array(
                'class' => 'btn btn-default'
            ));
            ?>
        </div>
    </div>

    <?php
    echo $this->Form->end();
    ?>
</div>