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
        <input type="tel" name="filters[phone_number]" id="phone">
        <label for="limit">Лимит результатов</label>
        <input type="number" name="limit" id="limit" value="5">
        <label for="offset">Смещение</label>
        <input type="number" name="offset" id="offset" value="0">
        <button type="submit" id="searchButton">Поиск</button>
    </form>

    <h1>Результат</h1>
    <div id="results"></div>

    <div id="pagination"></div>

    <script>
        $('#searchButton').on('click', function (event) {
          event.preventDefault();
          const phoneField = $('#phone');
          const phone = phoneField.val().replace(/\D/g, '');
          phoneField.val(phone);

          performSearch();
        });

        function performSearch() {
            const formData = $('#searchForm').serialize();

            $.ajax({
                url: `/student_search/search?${formData}`,
                method: 'GET',
                success: function (response) {
                    displayResults(response.data);
                    displayPagination(response);
                },
                error: function () {
                    $('#results').text('Ошибка поиска');
                }
            });
        }

        function displayResults(data) {
            $('#results').empty();
            if (data.length > 0) {
                data.forEach(item => {
                    const div = $('<div>').text(JSON.stringify(item));
                    $('#results').append(div);
                });
            } else {
                $('#results').text('Нет результатов');
            }
        }

        function displayPagination(meta) {
    $('#pagination').empty();

    const total = meta.total;
    const limit = meta.limit;
    const currentOffset = meta.offset;

    const totalPages = Math.ceil(total / limit);
    const currentPage = Math.floor(currentOffset / limit) + 1;

    for (let i = 1; i <= totalPages; i++) {
        const pageOffset = (i - 1) * limit;

        // Создание кнопки для страницы
        const pageButton = $('<button>')
            .text(i)
            .on('click', function () {
                $('#offset').val(pageOffset);
                performSearch();
            });

        // Выделение текущей страницы жирным
        if (i === currentPage) {
            pageButton.css('font-weight', 'bold');
        }

        $('#pagination').append(pageButton);
    }
}
    </script>
        
</body>
</html>