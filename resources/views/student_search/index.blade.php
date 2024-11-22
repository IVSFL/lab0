<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/studentSearch.js" defer></script>
    <title>Поиск студента</title>
</head>
<body>
    <h1>Поиск студента</h1>
    <form id="searchForm">
        <label for="name">Имя</label>
        <input type="text" name="filters[name]" id="name">
        <label for="email">Почта</label>
        <input type="email" name="filters[email]" id="email">
        <label for="phone">Номер телефона</label>
        <input type="tel" name="filters[phone]" id="phone">
        <label for="limit">Лимит результатов</label>
        <input type="number" name="limit" id="limit" value="5">
        <label for="offset">Смещение</label>
        <input type="number" name="offset" id="offset" value="0">
        <button type="submit" id="searchButton">Поиск</button>
    </form>

    <h1>Результат</h1>
    <div id="results"></div>

    <div id="pagination"></div>

        
</body>
</html>