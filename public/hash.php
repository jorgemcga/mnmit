<?php

$pass = filter_input(INPUT_GET, 'password');

if (empty($pass)) {
    die("Falta a senha");
}

echo password_hash($pass, PASSWORD_BCRYPT);
echo '<p>=D</p>';
