<?php
session_start();

require_once 'logic/admin/Admin.php';
require_once 'logic/student/Student.php';
require_once 'logic/professor/Professor.php';
require_once 'logic/program/Program.php';

include base64_decode($_GET['sid']);