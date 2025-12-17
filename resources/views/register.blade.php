<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Register</button>
</form>

@if ($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

</body>
</html>
