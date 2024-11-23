<?php

use Core\Authenticator;

(new Authenticator)->logout();

header('location: ' . getUrl('/'));
exit();