<?php

// render('contact/index', array(
//     'title' => 'Contact us'
// ));

$address = conf('contacts');
$title = 'Contact us';

render('contact/index', array(
    'title' => 'Contact us',
    'address' => $address
));


// render('contact/index', compact('title', 'address'));
