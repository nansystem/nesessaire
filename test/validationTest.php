<?php
require_once('../vendor/autoload.php');
use Respect\Validation\Validator as v;

$number = "123";
var_dump(v::numeric()->validate($number)); //true

$usernameValidator = v::alnum()->noWhitespace()->length(1,15);
$usernameValidator->validate('alganet'); //true

$user = new stdClass;
$user->name = 'Alexandre';
$user->birthdate = '1987-07-01';
$userValidator = v::attribute('name', v::string()->length(1,32))
                  ->attribute('birthdate', v::date()->minimumAge(18));

var_dump( $usernameValidator->validate($user)); //true
var_dump( $usernameValidator->validate('respect') );            //true
var_dump( $usernameValidator->validate('alexandre gaigalas') ); //false
var_dump( $usernameValidator->validate('#$%') );                //false

try {
    $usernameValidator->assert('really messed up screen#name');
} catch(\InvalidArgumentException $e) {
    $errors = $e->findMessages(array(
    'alnum'        => '{{name}} は文字と数字のみです。',
    'length'       => '{{name}} must not have more than 15 chars',
    'noWhitespace' => '{{name}} cannot contain spaces'
	));
    var_dump($errors);
}

v::date('Y-m-d')->between('1980-02-02', 'now')->setName('Member Since');




