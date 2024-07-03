<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <h1>Daily Report</h1>
    <ul>
        <li>Post Sayısı: {{$informations["postsCount"]}}</li>
        <li>Kişi Sayısı: {{$informations["usersCount"]}}</li>
        <li>Kategori Sayısı: {{$informations["categoriesCount"]}}</li>
    </ul>
    <br>
    <small>created by Muhammet Eren YILMAZ</small>
</body>
</html>