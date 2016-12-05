<?php
session_start();
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'config.php';
Route::start(); // запускаем маршрутизатор
