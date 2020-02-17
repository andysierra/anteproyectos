<?php
session_start();
require_once 'logic/admin/Admin.php';
require_once 'logic/student/Student.php';
require_once 'logic/program/Program.php';

$error = 0;
$newConfirmation = 0;
$topbar = "presentation/mainPage/topbars/MainTopbar.php";
$tabs = "";
$content = "presentation/mainPage/MainPage.php";
$user;

// SI VENGO DE CONFIRMAR UN NUEVO USUARIO
if(!empty($_POST['form_confirm_student'])) {
    $newUser = new Student("",$_POST['form_confirm_student'],"","","","","");
    if($newUser->userExists()) {
        if($newUser->confirmNewUser($_POST['form_confirm_student_password'],
                                 $_POST['form_confirm_student_email'],
                                 $_POST['form_confirm_student_profilepic'])) // aquí se activa al estudiante
                $error = -5;
        else $error = 5;
    }
}
else if(!empty($_POST['form_confirm_professor'])) {
    $error = -6;
}

// SI VENGO DESDE UN CORREO ELECTRÓNICO
if(!empty($_GET['email_activatestudent'])) {
    // FUTURE: verificar aquí si el hash que viene del correo es válido

    $newUser = new Student("",$_GET['email_activatestudent'],"","","","","");
    if($newUser->userExists())
    {
        if(!empty($_SESSION['entity'])) {
            $user = null;
            unset($_SESSION['id']);
            unset($_SESSION['entity']);
            unset($_SESSION);
            session_destroy();
            $error = 3;
        }
        $topbar  = "presentation/mainPage/topbars/MainTopbar.php";
        $tabs    = "";
        $content = "presentation/mainPage/EmailConfirmUser.php";
        $newConfirmation = 1;
    }
    else { // SI ESE USUARIO NO FUE CREADO
        // SI TENGO SESIÓN INICIADA
        if(!empty($_SESSION['entity']))
        {
            switch($_SESSION['entity']) {
                case 1:
                    $user = new Admin($_SESSION['id'],"","","","","");
                    $user->retrieveAccountData(true);
                    $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
                    $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
                    $content = "presentation/admin/Dashboard.php";
                    break;
                case 2:
                    $user = new Student($_SESSION['id'],"","","","","","");
                    $user->retrieveAccountData(true);
                    $topbar  = "presentation/student/topbars/Topbar_Dashboard.php";
                    $tabs    = "presentation/student/topbars/Tabs_Dashboard.php";
                    $content = "presentation/student/Dashboard.php";
                    break;
            }
        }
        $error = 4;
    }
}

// SI ESTÁ CERRANDO SESIÓN
if(!empty($_GET['exit'])){
    $user = null;
    unset($_SESSION['id']);
    unset($_SESSION['entity']);
    unset($_SESSION);
    session_destroy();
}

// SI HA CREADO UN NUEVO USUARIO
if(!empty($_SESSION['entity']) && !empty($_POST['form_create_student'])) {
    
    // verificar si el estudiante existe, o sino error 2
    $newUser = new Student("",$_POST['form_create_student_username'],
                           "","","","","");
    if($newUser->userExists())
        $error=2;
    else {
        $newUser->insertNewStudent ($_POST['form_create_student_fullname'],
                                    $_POST['form_create_student_program'],
                                    $_POST['form_create_student_email']);
        $error = -2;
    }
}

// SI YA HAY UN USUARIO EN SESIÓN   (PONGA LOS EMAIL REDIRS AQUÍ)
if(!empty($_SESSION['entity']) &&
   empty($_GET['email_activatestudent'])) {
    
    switch($_SESSION['entity']) {
        case 1:
            $user = new Admin($_SESSION['id'],"","","","","");
            $user->retrieveAccountData(true);
            $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
            $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
            $content = "presentation/admin/Dashboard.php";
            break;
        case 2:
            $user = new Student($_SESSION['id'],"","","","","","","");
            $user->retrieveAccountData(true);
            $topbar  = "presentation/student/topbars/Topbar_Dashboard.php";
            $tabs    = "presentation/student/topbars/Tabs_Dashboard.php";
            $content = "presentation/student/Dashboard.php";
            break;
    }
}
else {
    // SI NO HAY UN USUARIO Y SE LOGUEA
    if(!empty($_POST['form_login'])) {
        
        // authenticate as admin
        $user = new Admin("", $_POST['form_login_username'], $_POST['form_login_password'], "", "");
        if($user->auth() && $user->isActive()) {
            $user->retrieveAccountData(false);
            $_SESSION['id'] = $user->getId();
            $_SESSION['entity'] = 1;
            $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
            $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
            $content = "presentation/admin/Dashboard.php";
        }
        else {
            
            $user = new Student("",$_POST['form_login_username'], $_POST['form_login_password'],"","","","","");
            if($user->auth() && $user->isActive()) {
                $user->retrieveAccountData(false);
                $_SESSION['id'] = $user->getId();
                $_SESSION['entity'] = 2;
                $topbar  = "presentation/student/topbars/Topbar_Dashboard.php";
                $tabs    = "presentation/student/topbars/Tabs_Dashboard.php";
                $content = "presentation/student/Dashboard.php";
            }
            else {
                // BLOQUE DE CÓDIGO PARA CUANDO NINGUNO DE LOS USUARIOS EXISTA EN EL SISTEMA
                $error = 1;   
                $topbar  = "presentation/mainPage/topbars/MainTopbar.php";
                $tabs    = "";
                $content = "presentation/mainPage/MainPage.php";
            }
        }
    }
}

?>

<html>
    <head>
        <title>Bienvenidos</title>
        <link rel="stylesheet" href="src/css/all.css"/>
        <link rel="stylesheet" href="src/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="src/css/test.css"/>
        <link rel="stylesheet" href="src/css/proyecto1.css"/>
        <script src="src/js/all.js"></script>
        <script src="src/js/jquery.js"></script>
        <script src="src/js/bootstrap.min.js"></script>
        <script src="src/js/popper.js"></script>
    </head>
    
<?php
    include $topbar;
    if($tabs!="")include $tabs;
    include $content;
?>
</html>
