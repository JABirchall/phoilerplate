<?php
# region Router Init
use Phalcon\Mvc\Router\Group;
use Phalcon\Mvc\Router;

$router = new Router(false);
$router->setDI($di);
# endregion

$router->add('/', 'Index::index');

# region Admin Routes
$adminGroup = new Group();
$adminGroup->setPrefix('/admin');
$adminGroup->addGet('(\/)?', 'Admin::index');
$router->mount($adminGroup);
# endregion

$router->notFound('Error::notFound');


return $router;