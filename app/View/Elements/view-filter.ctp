<?php

echo $this->Form->create('Filter', array('type' => 'get', 'url' => array('controller' => 'data', 'action' => 'index'),
    'class' => 'formHorizontal', 'id' => 'FilterPreviewForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
?>
<h4>View records</h4>
<?php
echo $this->Form->input('filterrecords', array('type' => 'radio', 'options' => array('mine' => 'Mine', 'all' => 'All'), 'value' => $filterrecords,
    'legend' => false,
    'separator' => '</label></div><div class="radio"><label>',
    'before' => '<div class="radio"><label>',
    'after' => '</label></div>'));

echo $this->Form->end();
