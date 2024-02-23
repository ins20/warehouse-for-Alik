<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Склад</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style: none;
        font-family: sans-serif;
    }

    header,
    footer {
        background-color: aliceblue;
        text-align: center;
        padding: 15px;

    }

    form {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .container {
        height: 100vh;
        display: flex;
        gap: 10px
    }

    input,
    button,
    select {
        background: whitesmoke;
        padding: 5px;
        outline: none;
        border: 1px solid black;
        color: black;
    }

    nav {
        display: flex;
        gap: 10px;
    }

    nav a:hover {
        color: blue
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    main {
        flex: 1 0 auto
    }

    #editModal {
        display: none;
    }

    #editModal:target {
        display: block;
    }
</style>

<body>
    <header>
        <nav>
            <a href="#" onclick="$('main').load('./pages/main.php')">Главная</a>
            <a href="#" onclick="$('main').load('./pages/warehouse.php')">Склад</a>
        </nav>
    </header>
    <main>
        <?php require './pages/main.php' ?>
    </main>
    <footer>
        <p>Склад &copy; 2024</p>
    </footer>
</body>

</html>