<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентов</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Список студентов</h1>

    <h2>Создать студента</h2>
    <form id="createStudentForm">
        <label for="name">Имя</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Электронная почта</label>
        <input type="email" id="email" name="email" required>
        <label for="phone_number">Номер телефона</label>
        <input type="text" id="phone_number" name="phone_number" required>
        <button type="submit">Создать</button>
    </form>

    <hr>

    <button id="loadStudents">Загрузить студентов</button>
    <button id="deleteSelectedStudents">Удалить выбранных</button>

    <h2>Список студентов</h2>
    <table id="studentsTable" border="1">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll" /> Выбрать всех</th>
                <th>id</th>
                <th>Имя</th>
                <th>Эл. почта</th>
                <th>Номер телефона</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <h2>Обновить данные</h2>
    <form id="updateStudentForm" style="display: none;">
        <input type="hidden" id="updateStudentId">
        <label for="updateName">Name:</label>
        <input type="text" id="updateName" name="name" required>
        <label for="updateEmail">Email:</label>
        <input type="email" id="updateEmail" name="email" required>
        <label for="updatePhoneNumber">Phone Number:</label>
        <input type="text" id="updatePhoneNumber" name="phone_number" required>
        <button type="submit">Update Student</button>
    </form>

    <script>
        $(document).ready(function() {
            // Обработка формы создания студента
            $('#createStudentForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/student/create',
                    type: 'POST',
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone_number: $('#phone_number').val(),
                        _token: '{{ csrf_token() }}' // CSRF токен
                    },
                    success: function(response) {
                        alert('Студент создан');
                        $('#createStudentForm')[0].reset();
                        loadStudents();
                    },
                    error: function() {
                        alert('Ошибка создания');
                    }
                });
            });

            // Загрузка всех студентов
            function loadStudents() {
                $.ajax({
                    url: '/student/all',
                    type: 'GET',
                    success: function(data) {
                        let rows = '';
                        data.forEach(function(student) {
                            rows += `<tr>
                                <td><input type="checkbox" class="selectStudent" data-id="${student.id}" /></td>
                                <td>${student.id}</td>
                                <td>${student.name}</td>
                                <td>${student.email}</td>
                                <td>${student.phone_number}</td>
                                <td>
                                    <button onclick="editStudent(${student.id})">Редактировать</button>
                                    <button onclick="deleteStudent(${student.id})">Удалить</button>
                                </td>
                            </tr>`;
                        });
                        $('#studentsTable tbody').html(rows);
                    },
                    error: function() {
                        alert('Ошибка загрузки');
                    }
                });
            }

            // Функция редактирования студента
            window.editStudent = function(id) {
                $.ajax({
                    url: `/student/${id}`,
                    type: 'GET',
                    success: function(student) {
                        $('#updateStudentId').val(student.id);
                        $('#updateName').val(student.name);
                        $('#updateEmail').val(student.email);
                        $('#updatePhoneNumber').val(student.phone_number);
                        $('#updateStudentForm').show();
                    },
                    error: function() {
                        alert('Ошибка загрузки данных');
                    }
                });
            }

            // Обработка формы обновления студента
            $('#updateStudentForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: `/student/${$('#updateStudentId').val()}/update`,
                    type: 'POST',
                    data: {
                        name: $('#updateName').val(),
                        email: $('#updateEmail').val(),
                        phone_number: $('#updatePhoneNumber').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        alert('Обновление успешно');
                        loadStudents();
                        $('#updateStudentForm')[0].reset();
                        $('#updateStudentForm').hide();
                    },
                    error: function() {
                        alert('Ошибка обновления');
                    }
                });
            });

            // Функция удаления студента
            window.deleteStudent = function(id) {
                if (confirm('Уверены что хотите удалить?')) {
                    $.ajax({
                        url: `/student/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            alert('Удаление успешно');
                            loadStudents();
                        },
                        error: function() {
                            alert('Ошибка удаления');
                        }
                    });
                }
            }

            // Функция удаления выбранных студентов
            $('#deleteSelectedStudents').click(function() {
                let selectedIds = [];
                $('.selectStudent:checked').each(function() {
                    selectedIds.push($(this).data('id'));
                });

                if (selectedIds.length > 0) {
                    if (confirm('Уверены что хотите удалить?')) {
                        $.ajax({
                            url: '/student/delete-many',
                            type: 'POST',
                            data: {
                                ids: selectedIds,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                alert('Выбранные студенты удалены');
                                loadStudents();
                            },
                            error: function() {
                                alert('Ошибка удаления выбранных студентов');
                            }
                        });
                    }
                } else {
                    alert('Нужно выбать студентов');
                }
            });

            // Обработчик для выбора/отмены выбора всех студентов
            $('#selectAll').click(function() {
                let checked = $(this).prop('checked');
                $('.selectStudent').prop('checked', checked);
            });

            // Загрузка студентов при нажатии кнопки "Load Students"
            $('#loadStudents').click(function() {
                loadStudents();
            });
        });
    </script>
</body>
</html>
