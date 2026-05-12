<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Congrats!! You are logged in</p>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="loginName" placeholder="Name">
            <input type="password" name="loginPassword" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>
    @endauth


</body>
</html>