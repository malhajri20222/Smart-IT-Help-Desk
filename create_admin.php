<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smart IT Help Desk</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container" style="max-width:500px; margin-top:80px;">

    <div class="header">

        <img src="images/logo.png"
             alt="Logo"
             style="width:100px;display:block;margin:0 auto 20px;">

        <h1 style="font-size:32px;">
            Admin Login
        </h1>

        <p class="subtitle">
            Smart IT Help Desk
        </p>

    </div>

    <form action="authenticate.php" method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            placeholder="Enter your username"
            required>

        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Enter your password"
            required>

        <button
            type="submit"
            style="width:100%; margin-top:10px;">
            Login
        </button>

    </form>

</div>

</body>
</html>