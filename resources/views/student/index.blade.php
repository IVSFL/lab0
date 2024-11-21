<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентов</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Список студентов</h1>

    <h2>Создать студента</h2>
    <form id="createStudentForm" action="route{{'student.create'}}" method="post">
        @csrf
        @method('post')
        <div id="createError" style="background-color: red"></div>
        <label for="name">Имя</label>
        <input type="text"
         id="name" 
         name="name"
         required>
        <label for="email">Электронная почта</label>
        <input type="email" id="email" name="email" required>
        <label for="phone_number">Номер телефона</label>
        <input type="tel"
            id="phone_number"
            name="phone_number"
            pattern="8[0-9]{10}" 
            title="Номер телефона введен не верно. Должен начинатся с 8, и состоять из 11 цифр"
            required>
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
                <th>Имя</th>
                <th>Эл. почта</th>
                <th>Номер телефона</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <h2>Обновить данные</h2>
    <form id="updateStudentForm" method="post" action="route{{'student.update'}}" style="display: none;">
        @csrf
        @method('post')
        <div id="updateError" style="background: red"></div>
        <input type="hidden" id="updateStudentId">
        <label for="updateName">Имя</label>
        <input type="text"
         id="updateName"
         name="name"
         pattern="[A-Za-zА-Яа-яЁё\s.-',()]{2,}"
         title="Поле не должно быть пустым, не должны присутствовать цифры, и состоять только из пробелов"
         required>
        <label for="updateEmail">Эл почта</label>
        <input type="email" id="updateEmail" name="email" required>
        <label for="updatePhoneNumber">Номер телефона</label>
        <input type="text" 
         id="updatePhoneNumber" 
         name="phone_number" 
         pattern="8[0-9]{10}" 
         title="Номер телефона введен не верно. Должен начинатся с 8, и состоять из 11 цифр"
         required>
        <button type="submit">Обновить</button>
    </form>

    <script>
        $(document).ready(function() {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          console.log("CSRF Token:", $('meta[name="csrf-token"]').attr('content'));
            // создания студента
            $('#createStudentForm').submit(function(e) {
                e.preventDefault();

                $('#createError').html('');
                $.ajax({
                    url: '/student/create',
                    type: 'POST',
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone_number: $('#phone_number').val(),
                    },
                    success: function(response) {
                        alert('Студент создан');
                        $('#createStudentForm')[0].reset();
                        loadStudents();
                    },
                    error: function(xhr) {
                      if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, messages) {
                          messages.forEach(function(message) {
                            errorMessage += '<p>' + message + '</p>';
                          });
                        });
                        $('#createError').html(errorMessage);
                      } else {
                        alert('Ошибка');
                      }
                    }
                });
            });

            // загрузка всех студентов
            function loadStudents() {
                $.ajax({
                    url: '/student/all',
                    type: 'GET',
                    success: function(data) {
                        data.sort(function(a, b){
                            return a.name.localeCompare(b.name, 'en', {sensitivity: 'base'}) || a.name.localeCompare(b.name, 'ru', {sensitivity: 'base'});
                        });
                        let rows = '';
                        data.forEach(function(student) {
                            rows += `<tr>
                                <td><input type="checkbox" class="selectStudent" data-id="${student.id}" /></td>
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

            // редактирования студента
            window.editStudent = function(id) {
                $.ajax({
                    url: `/student/retrieve/${id}`,
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

            // обновления студента
            $('#updateStudentForm').submit(function(e) {
                e.preventDefault();
                $('#updateError').html('');
                $.ajax({
                    url: `/student/update/${$('#updateStudentId').val()}`,
                    type: 'POST',
                    data: {
                        name: $('#updateName').val(),
                        email: $('#updateEmail').val(),
                        phone_number: $('#updatePhoneNumber').val(),
                        //_token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        alert('Обновление успешно');
                        loadStudents();
                        $('#updateStudentForm')[0].reset();
                        $('#updateStudentForm').hide();
                    },
                    error: function(xhr) {
                        if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, messages) {
                          messages.forEach(function(message) {
                            errorMessage += '<p>' + message + '</p>';
                          });
                        });
                        $('#updateError').html(errorMessage);
                      } else {
                        alert('Ошибка');
                      }
                    }
                });
            });

            // удаление студента
            window.deleteStudent = function(id) {
                if (confirm('Уверены что хотите удалить?')) {
                    $.ajax({
                        url: `/student/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            //_token: '{{ csrf_token() }}'
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

            // удаление выбранных студентов
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
                                //_token: '{{ csrf_token() }}'
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

            // выбор студентов
            $('#selectAll').click(function() {
                let checked = $(this).prop('checked');
                $('.selectStudent').prop('checked', checked);
            });

            // зашрузка студентов по нажатью кнопки
            $('#loadStudents').click(function() {
                loadStudents();
            });

            $(document).ready(function(){
                loadStudents();
            });
        });
    </script>
</body>
</html>
