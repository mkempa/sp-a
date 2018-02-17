<?php
echo $this->Form->create('Filter', array('type' => 'get', 'url' => array('controller' => 'data', 'action' => 'index'),
    'id' => 'FilterPreviewForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
?>
<div class="col-md-2">
    <h4>View records</h4>
    <?php
    echo $this->Form->input('filterrecords', array(
        'type' => 'radio',
        'options' => array('mine' => 'Mine', 'all' => 'All'),
        'value' => $filterrecords,
        'class' => 'submit-on-click',
        'legend' => false,
        'separator' => '</label></div><div class="radio"><label>',
        'before' => '<div class="radio"><label>',
        'after' => '</label></div>'));
    ?>
</div>
<div class="col-md-2">
    <div id="checklist-filter-types">
        <h4>Types</h4>
        <div class="checkbox">
            <?php
            echo $this->Form->input('types[]', array(
                'type' => 'checkbox',
                'id' => 'filter-types-all',
                'class' => 'submit-on-click',
                'value' => 'All',
                'label' => 'All',
                'hiddenField' => false,
                'checked' => $this->Format->checkOption($checkedTypes, 'All')
                    )
            );
            ?>
        </div>
        <hr />
        <?php
        $types = array('A' => 'A', 'PA' => 'PA', 'S' => 'S', 'DS' => 'DS');
        foreach ($types as $key => $value) :
            ?>
            <div class="checkbox">
                <?php
                echo $this->Form->input('types[]', array(
                    'type' => 'checkbox',
                    'class' => 'submit-on-click',
                    'value' => $key,
                    'label' => $value,
                    'hiddenField' => false,
                    'checked' => $this->Format->checkOption($checkedTypes, $key)
                        )
                );
                ?>
            </div>
            <?php
        endforeach;

//        echo $this->Form->input('types', array(
//            'multiple' => 'checkbox',
//            'options' => $types,
//            'label' => false,
//            'hiddenField' => false,
//            'input' => array('class' => 'submit-on-click'),
//            'div' => false)
//        );
        ?>
    </div>
</div>
<div class="col-md-6">
    <?php
    echo $this->Form->input('freetext', array('class' => 'form-control', 'placeholder' => 'Search'));
    ?>
</div>
<?php
echo $this->Form->end();
