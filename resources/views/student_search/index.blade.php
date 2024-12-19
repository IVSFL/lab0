<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Поиск студента</title>
</head>
<body>
    <h1>Поиск студента</h1>
    <form id="searchForm">
        <label for="name">Имя</label>
        <input type="text" name="name" id="name">
        <label for="email">Почта</label>
        <input type="email" name="email" id="email">
        <label for="phone">Номер телефона</label>
        <input type="tel" name="phone_number" id="phone">
        <label for="limit">Лимит результатов</label>
        <input type="number" name="limit" id="limit" value="5">
        <label for="offset">Смещение</label>
        <input type="number" name="offset" id="offset" value="0">
        <button type="submit" id="searchButton">Поиск</button>
    </form>

    <h1>Результат</h1>
    <table id="resultsTable" border="1" style="width:100%; text-align:left; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Почта</th>
                <th>Номер телефона</th>
            </tr>
        </thead>
        <tbody id="results"></tbody>
    </table>

    <div id="pagination"></div>

    <script>
        $('#searchButton').on('click', function (event) {
            event.preventDefault();

            const phoneField = $('#phone');
            const phone = phoneField.val().replace(/\D/g, '').slice(0, 11);
            phoneField.val(phone);

            const limitField = $('#limit');
            const offsetField = $('#offset');
            const limit = parseInt(limitField.val(), 10);
            const offset = parseInt(offsetField.val(), 10);

            if(isNaN(limit) || limit <= 0) {
                limitField.val(5);
            }
            if(isNaN(offset) || offset < 0) {
                offsetField.val(0);
            }

            performSearch();
        });

        function performSearch() {
            let formData = $('#searchForm').serialize();

            //formData = formData.replace(/%20/g, ' ');
            //console.log(formData)

            //formData = formData.replace(/%20/g, ' ');
            //console.log(formData)
            $.ajax({
                url: `/student_search/search?${formData}`,
                method: 'GET',
                success: function (response) {
                    displayResults(response.data);
                    displayPagination(response);
                },
                error: function () {
                    $('#results').html('<tr><td colspan="3">Ошибка поиска</td></tr>');
                }
            });
        }

        function displayResults(data) {
            const resultsTable = $('#results');
            resultsTable.empty();

            if (data.length > 0) {
                data.forEach(item => {
                    const row = `
                        <tr>
                            <td>${item.name}</td>
                            <td>${item.email}</td>
                            <td>${item.phone_number}</td>
                        </tr>
                    `;
                    resultsTable.append(row);
                });
            } else {
                resultsTable.html('<tr><td colspan="3">Нет результатов</td></tr>');
            }
        }

        function displayPagination(meta) {
            $('#pagination').empty();

            const total = meta.total;
            const limit = meta.limit;
            const currentOffset = parseInt($('#offset').val(), 10) || 0;
            const totalPages = Math.ceil(total / limit);
            const currentPage = Math.floor(currentOffset / limit) + 1;

            for (let i = 1; i <= totalPages; i++) {
                const pageOffset = (i - 1) * limit + (currentOffset % limit);

                const pageButton = $('<button>')
                    .text(i)
                    .on('click', function () {
                        $('#offset').val(pageOffset);
                        performSearch();
                    });

                if (i === currentPage) {
                    pageButton.css('font-weight', 'bold');
                }

                $('#pagination').append(pageButton);
            }
        }
    </script>
</body>
</html>