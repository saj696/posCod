<?php // Change the css classes to suit your needs
$attributes = array('class' => 'email', 'id' => 'myform');
echo form_open('email/send', $attributes);

$data = array(
    'name'  => 'John Doe',
    'email' => 'john@example.com',
    'url'   => 'http://example.com'
);

echo form_hidden($data);

$data = array(
    'name'        => 'username',
    'id'          => 'username',
    'value'       => 'johndoe',
    'maxlength'   => '100',
    'size'        => '50',
    'style'       => 'width:50%',
);

echo form_input($data);

