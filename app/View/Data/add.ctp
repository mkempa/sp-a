<?php

echo $this->element('record-view-edit', array(
    'result' => array(),
    'list_of_species' => $loss,
    'accepted' => $accepted,
    'genera' => $genera,
    'edit' => false
        )
);
