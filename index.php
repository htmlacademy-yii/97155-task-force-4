<?php
use taskforce\models\Task;

require_once 'vendor/autoload.php';

$task = new Task (Task::STATUS_NEW, 33);
