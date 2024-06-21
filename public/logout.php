<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$session->destroySession();
Renderer::redirect('/index.php');