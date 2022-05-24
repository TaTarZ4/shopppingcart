<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fome class="cd" action="{{route('product.store')}}" method="post">
        @csrf
        <input type="text" class="id" name="name">
        <input type="number" class="id" name="price">
        <button type="submit">สร้าง</button>
    </fome>
</body>
</html>