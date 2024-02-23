<div class="container">
    <form id="addForm">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="brand">Бренд:</label>
        <input type="text" id="brand" name="brand" required>
        <br>
        <label for="group">Группа:</label>
        <select name="group" id="group">
        </select>
        <br>
        <label for="cost">Цена:</label>
        <input type="number" id="cost" name="cost" required min="0">
        <br>
        <button type="submit">Добавить</button>
    </form>
    <table id="myTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Бренд</th>
                <th>Группа</th>
                <th>Цена</th>
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
        <br>
        <label for="editBrand">Бренд:</label>
        <input type="text" id="editBrand" name="brand" required>
        <br>
        <label for="editGroup">Группа:</label>
        <select name="group" id="group"></select>
        <br>
        <label for="editCost">Цена:</label>
        <input type="number" id="editCost" name="cost" required>
        <br>
        <button>Сохранить</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "./api/group/getAll.php", // замените на свой адрес API или серверный скрипт, который возвращает данные
            method: "GET",
            dataType: "json", // указываете тип данных, возвращаемых сервером (JSON, XML и т.д.)
            success: function(data) {
                var select = $('select[name="group"]');
                $.each(data, function(key, {
                    id,
                    name
                }) {

                    select.append('<option value="' + id + '">' + name + '</option>');
                });
            }
        });
        var dataTable = $('#myTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Russian.json"
            },
            ajax: {
                url: "./api/product/getAll.php", // URL для получения данных из сервера
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
                    data: "brand"
                }, {
                    data: "group_id"
                }, {
                    data: "cost"
                },
                {
                    data: "actions",
                    orderable: false,
                    render: function(data, type, row) {
                        return '<a href="#editModal" class="editBtn" data-id="' + row.id + '">Редактировать</a>';
                    }
                }

            ]
        });
        dataTable.ajax.reload();
        $('#addForm').submit(function(event) {
            event.preventDefault(); // Предотвращаем обычное поведение формы

            // Получаем значения полей формы
            var name = $('#name').val();
            var brand = $('#brand').val();
            var group = $('#group').val();
            var cost = $('#cost').val();

            // Отправляем AJAX-запрос на сервер для сохранения данных
            $.ajax({
                url: './api/product/add.php', // URL для обработки запроса
                type: 'POST',
                data: {
                    name: name,
                    brand: brand,
                    group_id: group,
                    cost: cost
                },
                dataType: 'json',
                success: function(response) {
                    // Обработка успешного ответа
                    if (response.success) {
                        // Очищаем поля формы
                        $('#name').val('');
                        $('#brand').val('');
                        $('#group').val('');
                        $('#cost').val('');

                        // Обновляем таблицу
                        dataTable.ajax.reload();
                    } else {
                        // Выводим сообщение об ошибке
                        alert('Error: ' + response.message);
                    }
                }
            });
        });
        $('#myTable').on('click', '.editBtn', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: './api/product/getById.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: productId
                },
                success: function(response) {
                    var product = response[0];
                    $('#editId').val(product.id);
                    $('#editName').val(product.name);
                    $('#editBrand').val(product.brand);
                    $('#editCost').val(product.cost);
                    $('#editGroup').val(product.group_id);
                }
            });
        });
        $('#editForm').submit(function(event) {
            event.preventDefault();
            var productId = $('#editId').val();
            var name = $('#editName').val();
            var email = $('#editEmail').val();

            $.ajax({
                url: 'update_user.php',
                type: 'POST',
                data: {
                    id: productId,
                    name: name,
                    email: email
                },
                success: function(response) {
                    if (response.success) {
                        $('#editModal').hide();
                        dataTable.ajax.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            });
        });
    });
</script>