<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form enctype="multipart/form-data" action="/test/upload" method="post">
    {{csrf_field()}}
    <input name="image" type="file">
    <input type="submit">
</form>
</body>
</html>