<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>API documentation</title>
  <link rel="stylesheet" href="../../css/default-style.css">
  <link rel="stylesheet" href="../../css/login-modal-style.css">
  <link rel="stylesheet" href="../../css/sidebar-style.css">
  <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico"/>
</head>
<style>
    table, th, td {
        text-align: left;
        border: 2px solid black;
        border-collapse: collapse;
        padding: 5px;
        max-width: 1500px;
    }
</style>
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
          onclick="window.location.href=''">API
  </button>
  <button id="openLoginModalBtn" class="headerElement headerBtn">Sign in</button>
</header>

<div class="sidenav">
  <h2>Resources</h2>
  <a href="users.php">Users</a>
  <a href="groups.php">Groups</a>
  <a href="group-members.php">Group Members</a>
  <a href="tasks.php">Tasks</a>
  <a href="tokens.php">Tokens</a>
</div>

<section class="defaultSection main">
  <h1>Documentation</h1>
  <p>Here you can find information about the API and how to use it.</p>
  <p>Use the sidebar to get more information about specific resource.</p>
</section>

<section class="defaultSection main">
  <h1>About resources</h1>
  <p>The API tries to follow REST guidelines. REST is all about resources and so is this API.</p>
  <p>Each resource has its own Uniform
    Resource Locator (URL) that is used to access it.
    </p>

  <p>For example, we have a "user" resource that contains information about specific user.
    A user is identified by it's unique identifier, userid. For a specific user,
    the URL would be "{domain}/api/users/{userid}", where domain is name of
    the domain that is hosting the API and userid is the id of the user. Using this URL, we can
    access the user's information.</p>
</section>

<section class="defaultSection main">
  <h1>How to make a request</h1>
  <p>The API as a whole supports the following HTTP-methods: GET, POST, PUT, DELETE.
  However some resources do not support all of them.
  Each resource has it's own supported methods, which are listed in the documentation of the
    resource.</p>
  <p>To make a request to the API, you have to send a HTTP-request to the URL of the resource.
  Some of the API requests require input data from the client. For example, when creating a user,
    you have to provide name, password and email in your request. The input data must be included
    in JSON format in the body of the HTTP-request.
  </p>

  <pre>
{
  "name": "James",
  "password": "12345678",
  "email": "james@example.com"
}</pre>
  <p class="imgCaption">Example of a POST-request to "/api/users"</p>
</section>

<section class="defaultSection main">
  <h1>Authorization and tokens</h1>
  <p>A user can only access their own resources. If the user belongs to a group, they can also
  access resources of the group. However, some requests such as modifying details of the group
    require master privileges. Master privileges are automatically granted to the creator of the
    group.</p>
  <p>A token is required for authorization. There are currently three kinds of tokens:
    access tokens, refresh tokens and group tokens.</p>
  <h2>Access token</h2>
  <p>A relatively short lived token. Used for authorizing a user when they are accessing resources
    that are not visible to everyone. For example, user details can only be accessed by the
    user themselves by providing an access token with the request. Access token is also needed when
    the user tries to access their group's resources.</p>
  <h2>Refresh token</h2>
  <p>Refresh token has only one simple use: get a new access token. Refresh token is long lived
    and currently it expires after 6 months.</p>
  <h2>Group token</h2>
  <p>Currently used only for creating a new member for a group.</p>
  <h2>Transferring tokens</h2>
  <p>The information on how to transfer the token can be found in the documentation of the request.
    In most cases, the token has to be provided in the Authorization header of the request
    in the following format: </p><pre>Bearer {token here}</pre>
</section>

<section class="defaultSection main">
  <h1>Responses</h1><br>
  <h2>Format</h2>
  <p>The API responds to requests in JSON format. Typically the response body contains an
    JSON-object but some responses may return an JSON-array instead of an object.
    <b>A JSON-object is assumed unless otherwise specified in the documentation.</b></p>

  <pre>
{
  "id": 3,
  "name": "James",
  "email": "james@example.com"
}</pre>

  <p class="imgCaption">Example of an API response for POST-request to /api/users</p>

    <p>To find out what key-value pairs each response contains,
    check the documentation of the request.</p>

  <h2>Errors</h2>

  <p>If something is wrong with the request or the API raises an exception, an error response
    will be returned. Error responses contain information about the error.
    A list of the errors which can be returned for a specific request
    can be found in the documentation of the request.</p>

  <p>Error responses contain an error type and a message. Some errors include details but they are
    provided mainly for debugging purposes whereas the message is meant for users.
    If details are not provided, the value of "details" will be null.</p>

  <pre>
{
  "type": "invalid_password",
  "message": "Password must be 8-85 characters long.",
  "details": "The value of 'password' is too short"
}</pre>
  <p class="imgCaption">Example of an error response for invalid password</p>
  <p>Side note: Implementing your own password validation functionality (check if the password
    meets requirements) in your application is recommended to reduce the amount of unnecessary
    API calls.</p>
</section>

<script src="../../js/login-modal.js"></script>
</body>
</html>


<?php


?>

