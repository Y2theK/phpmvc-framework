<?php

$app = require_once __DIR__.'/bootstrap/app.php';

$app->db->applyMigrations();
