<?php

session_start();

require_once('utils.php');

logout();

header("Location: ../index.php");