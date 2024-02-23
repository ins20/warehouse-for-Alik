<style>
    #warehouseNav {
        display: flex;
        gap: 20px;
        flex-direction: column;
        background-color: whitesmoke;
        padding: 15px;
        height: 100%;
    }
</style>
<div class="container">
    <nav id="warehouseNav">
        <a href="#" onclick="$('#warehouse').load('pages/products.php')">Продукты</a>
        <a href="#" onclick="$('#warehouse').load('pages/groups.php')">Группы</a>
    </nav>

    <div id="warehouse">
        <?php require 'products.php' ?>
    </div>
</div>