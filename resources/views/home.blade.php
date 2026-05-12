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

     <div style="border: 3px solid black">
        <h2>Create New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post Title">
            <textarea name="body" placeholder="Body Content...."></textarea>
            <button type="submit">Create Post</button>
        </form>
     </div>

     <div style="border: 3px solid black">
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}}</h3>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit Post</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete Post</button>
            </form>
        </div>
        @endforeach
     </div>

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