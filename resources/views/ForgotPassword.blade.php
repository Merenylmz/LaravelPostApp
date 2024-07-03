<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Forgot Password Link</h1>
    <p>If you wanna change your password for forget your pass, You Should click a link</p>
    <br>
    <a href="http://localhost:8000/api/auth/newpassword/{{$token}}" class="btn btn-primary">Click Here</a>
</body>
</html>