<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rental Mobil Management</title>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        nav {
            background: #eee;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        nav a:hover {
            color: #007bff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            background: #ddd;
            color: black;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        form {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 500px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php?entity=jenis">Data Jenis Mobil</a>
        <a href="index.php?entity=mobil">Data Mobil</a>
        <a href="index.php?entity=penyewa">Data Penyewa</a>
        <a href="index.php?entity=transaksi">Transaksi Rental</a>
    </nav>

    <hr>
