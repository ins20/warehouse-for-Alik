<div class="container">
    <form id="addForm">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Добавить</button>
    </form>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div id="editModal">
    <a href="#">закрыть</a>
    <form id="editForm">
        <input type="hidden" id="editId" name="id">
        <label for="editName">Название:</label>
        <input type="text" id="editName" name="name" required>
        <button>Сохранить</button>
    </form>
</div>
<script>
    $(document).ready(function() {

        var dataTable = $('#myTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json"
            },
            ajax: {
                url: "./api/group/getAll.php", // URL для получения данных из сервера
                dataSrc: '',
                method: "GET"
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "name"
                },

                {
                    data: "actions",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<a href=#editModal class="editBtn" data-id="' + row.id + '">Редактировать</a>';
                    }
                }

            ]
        });
        dataTable.ajax.reload()
        $('#addForm').submit(function(event) {
            event.preventDefault(); // Предотвращаем обычное поведение формы

            // Получаем значения полей формы
            var name = $('#name').val();

            // Отправляем AJAX-запрос на сервер для сохранения данных
            $.ajax({
                url: './api/group/add.php', // URL для обработки запроса
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                },
                success: function(response) {
                    if (response.success) {
                        // Очищаем поля формы
                        $('#name').val('');
                        // Обновляем таблицу
                        dataTable.ajax.reload();

                        alert('Успешно добавлено');
                    } else {
                        // Выводим сообщение об ошибке
                        alert('Не удалось добавить');
                    }
                }
            });
        });
        $('#myTable').on('click', '.editBtn', function() {
            var groupId = $(this).data('id');
            $.ajax({
                url: './api/group/getById.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: groupId
                },
                success: function(response) {
                    $('#editName').val(response[0].name);
                    $('#editId').val(response[0].id);
                }
            });
        });
        $('#editForm').submit(function(event) {
            event.preventDefault();
            var groupId = $('#editId').val();
            var name = $('#editName').val();
            $.ajax({
                url: './api/group/update.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: groupId,
                    name: name,
                },
                success: function(response) {
                    dataTable.ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>