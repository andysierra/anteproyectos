<?php
session_start();
require_once 'logic/admin/Admin.php';
require_once 'logic/student/Student.php';
require_once 'logic/professor/Professor.php';
require_once 'logic/program/Program.php';
require_once 'logic/project/Project.php';

$error = 0;
$newConfirmation = 0;
$topbar = "presentation/mainPage/topbars/MainTopbar.php";
$tabs = "";
$tabid = "";
$content = "presentation/mainPage/MainPage.php";
$user;
$jumpLogedUser = false;

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
    $newUser = new Professor("",$_POST['form_confirm_professor'],"","","","","");
    if($newUser->userExists(false)) {
        if($newUser->confirmNewUser($_POST['form_confirm_professor_password'],
                                 $_POST['form_confirm_professor_email'],
                                 $_POST['form_confirm_professor_profilepic'])) // aquí se activa al profesor
                $error = -5;
        else $error = 5;
    }
}

// SI VENGO DESDE UN CORREO ELECTRÓNICO
if(!empty($_GET['email_activatestudent']) || !empty($_GET['email_activateprofessor'])) {
    // FUTURE: verificar aquí si el hash que viene del correo es válido

    if(!empty($_GET['email_activatestudent'])) {
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
    }
    else if(!empty($_GET['email_activateprofessor'])) {
        $newUser = new Professor("",$_GET['email_activateprofessor'],"","","","","");
        if($newUser->userExists(false))
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
            $newConfirmation = 2;
        }
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
                case 3:
                    $user = new Professor($_SESSION['id'],"","","","","","");
                    $user->retrieveAccountData(true);
                    $topbar  = "presentation/professor/topbars/Topbar_Dashboard.php";
                    $tabs    = "presentation/professor/topbars/Tabs_Dashboard.php";
                    $content = "presentation/professor/Dashboard.php";
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
    if($newUser->userExists()) {
        $error=2;
        $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
        $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
        $content = "presentation/admin/Tab_Professors.php";
        $jumpLogedUser = true;
    }
    else {
        $newUser->insertNewStudent ($_POST['form_create_student_fullname'],
                                    $_POST['form_create_student_program'],
                                    $_POST['form_create_student_email']);
        $error = -2;
        $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
        $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
        $content = "presentation/admin/Tab_Students.php";
        $jumpLogedUser = true;
        
    }
}
else {
    if(!empty($_SESSION['entity']) && !empty($_POST['form_create_professor'])) {
    
        // verificar si el profesor existe, o sino error 2
        $newUser = new Professor("",$_POST['form_create_professor_username'],
                               "","","","","");
        if($newUser->userExists(false)) {
            $error=2;
            $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
            $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
            $content = "presentation/admin/Tab_Professors.php";
            $jumpLogedUser = true;
        }
        else {
            $newUser->insertNewProfessor ($_POST['form_create_professor_fullname'],
                                        $_POST['form_create_professor_program'],
                                        $_POST['form_create_professor_email']);
            $error = -2;
            $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
            $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
            $content = "presentation/admin/Tab_Professors.php";
            $jumpLogedUser = true;
        }
    }
    else {
        if(!empty($_SESSION['entity']) && !empty($_POST['form_create_project'])) {
            
            // verificar si el proyecto existe, o sino error 10
            $newProject = new Project("",
                    $_POST['form_create_project_title'],
                    $_POST['form_create_project_abstract'],
                    $_POST['form_create_project_problem_statement'],
                    $_POST['form_create_project_objectives'],
                    $_POST['form_create_project_pdf_url'],
                    0,
                    $_SESSION['id']);
            if($newProject->exists())
                $error=10;
            else {
                $newProject->insert();
                $error = -10;
            }
        }
    }
}

// SI YA HAY UN USUARIO EN SESIÓN   (PONGA LOS EMAIL REDIRS AQUÍ)
if(!empty($_SESSION['entity']) &&
   empty($_GET['email_activatestudent'])) {
    
    switch($_SESSION['entity']) {
        case 1:
            $user = new Admin($_SESSION['id'],"","","","","");
            $user->retrieveAccountData(true);
            if(!$jumpLogedUser) {
                $topbar  = "presentation/admin/topbars/Topbar_Dashboard.php";
                $tabs    = "presentation/admin/topbars/Tabs_Dashboard.php";
                $content = "presentation/admin/Dashboard.php";
            $tabid   = "presentation/admin/Tab_Home.php";
                $jumpLogedUser = false;
            }
            break;
        case 2:
            $user = new Student($_SESSION['id'],"","","","","","","");
            $user->retrieveAccountData(true);
            if(!$jumpLogedUser) {
                $topbar  = "presentation/student/topbars/Topbar_Dashboard.php";
                $tabs    = "presentation/student/topbars/Tabs_Dashboard.php";
                $content = "presentation/student/Dashboard.php";   
            $tabid   = "presentation/student/Tab_Home.php";
                $jumpLogedUser = false;
            }
            break;
        case 3:
            $user = new Professor($_SESSION['id'],"","","","","","","");
            $user->retrieveAccountData(true);
            if(!$jumpLogedUser) {
                $topbar  = "presentation/professor/topbars/Topbar_Dashboard.php";
                $tabs    = "presentation/professor/topbars/Tabs_Dashboard.php";
                $content = "presentation/professor/Dashboard.php";   
            $tabid   = "presentation/professor/Tab_Home.php";
                $jumpLogedUser = false;
            }
            break;
    }
    
    // ESPACIO PARA REDIRS
    if(!empty($_GET['tid'])) {
        $tabid = base64_decode($_GET['tid']);
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
            $tabid   = "presentation/admin/Tab_Home.php";
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
                $tabid   = "presentation/student/Tab_Home.php";
            }
            else {
                $user = new Professor("",$_POST['form_login_username'], $_POST['form_login_password'],"","","","","");
                if($user->auth() && $user->isActive()) {
                $user->retrieveAccountData(false);
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['entity'] = 3;
                    $topbar  = "presentation/professor/topbars/Topbar_Dashboard.php";
                    $tabs    = "presentation/professor/topbars/Tabs_Dashboard.php";
                    $content = "presentation/professor/Dashboard.php";
                    $tabid   = "presentation/professor/Tab_Home.php";
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
    if($topbar!="")include $topbar;
    if($tabs!="")include $tabs;
    if($content!="")include $content;
?>
</html>
