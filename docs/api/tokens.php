<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API - Tokens</title>
    <link rel="stylesheet" href="../../css/default-style.css">
    <link rel="stylesheet" href="../../css/login-modal-style.css">
    <link rel="stylesheet" href="../../css/sidebar-style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico"/>
</head>
<body>
<div class="loginModal" id="loginModal">
    <div class="loginModalContent">
        <button id="closeLoginModalBtn">&times;</button>
        <h2 class="formHeader">Sign in</h2>
        <br><br>
        <label for="username" class="formLabel">Username</label>
        <input id="username" class="formField" type="text">
        <br>
        <label for="password" class="formLabel">Password</label>
        <input id="password" class="formField" type="password">
        <br>
        <button id="loginBtn">Login</button>
    </div>
</div>
<header>
    <a href="../../index.html" class="headerElement">
        <img src="../../img/logo.png" id="logo" alt="Logo"></a>
    <button id="aboutBtn" class="headerElement headerBtn"
            onclick="window.location.href='../../about.html'">About
    </button>
    <button id="appBtn" class="headerElement headerBtn"
            onclick="window.location.href='../../app.html'">The app
    </button>
    <button id="apiDocsBtn" class="headerElement headerBtn"
            onclick="window.location.href='index.php'">API
    </button>
    <button id="openLoginModalBtn" class="headerElement headerBtn">Sign in</button>
</header>

<div class="sidenav">
    <h2>Resources</h2>
    <a href="users.php">Users</a>
    <a href="groups.php">Groups</a>
    <a href="group-members.php">Group Members</a>
    <a href="tasks.php">Tasks</a>
    <a class="selectedPage" href="tokens.php">Tokens</a>
    <section class="subSection">
      <?php
    require __DIR__ . '/ResourceDoc.php';
    $actionTitles = ResourceDoc::getActionTitles("tokens");
    foreach ($actionTitles as $title) {
        $titleWithoutSpaces = ResourceDoc::replaceSpaces($title);
        echo '<a class="subSection" href="#' . $titleWithoutSpaces . '">' . $title . '</a>';
    }
    ?>
    </section>
</div>

<?php
ResourceDoc::printDocumentation("tokens");
?>

<script src="../../js/login-modal.js"></script>
</body>
</html>