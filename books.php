<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

function getBooks() {
    $token = '3d44e5cd027b6d7fa15287d76101eef2d9ec74fa3e0b7e03c77c8bc1b66799b4a4ecf2c5aab278c2d26fa2fdef2014ed532615e79c7e1bcd02734d721201a772b89f9fe31baee65a459489b8cf49a608bd34501f93324d17c08accd33b84bfd911dc571c8079c42c29295084ee8e63b7ea853f5f7f6a8e9b01dece829e74303e';
    $client = new Client(['base_uri' => 'http://localhost:1337/api/books']);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=100', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $books_list = json_decode($body);
    return $books_list;
    var_dump($books_list);
}

$books = getBooks();

?>

<html>
<head>
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container justify-center">
        <h1>List of All Books of the Bible and their Authors</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($books->data as $book_data) {
            $book = $book_data->attributes;
            ?>
                <tr>
                <th scope="row"><?php echo $book_data->id; ?></th>
                <td><?php echo $book->name; ?></td>
                <td><?php echo $book->author; ?></td>
                <td><?php echo $book->category; ?></td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>