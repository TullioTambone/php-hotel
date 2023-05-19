<?php
    // Stampare tutti i nostri hotel con tutti i dati disponibili.
    // Iniziate in modo graduale.
    // Prima stampate in pagina i dati, senza preoccuparvi dello stile.
    // Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
    // Bonus:
    // 1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
    // 2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
    // NOTA: deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
    // Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel.

    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ]
    ];

    $parcheggio = $_GET['parcheggio'];
    $voto = $_GET['voto'];

    $filtroVoto = array_filter($hotels, function ($element) use ($voto, $parcheggio) {
        if ($element['vote'] >= $voto && $element['parking'] == ($parcheggio === 'true')) {
            return true;
        } else{
            return false;
        }
    });
    var_dump($voto, $parcheggio)
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
    
    <form action="index.php" method="GET">
        <div class="mb-3 p-3 d-flex">
            <div>
                <label for="trovaParcheggio">includere il parcheggio?</label>
                <select name="parcheggio" id="trovaParcheggio" class="d-block">
                    <option selected="true" value="">tutti gli hotels</option>
                    <option value="true">SI</option>
                    <option value="false">NO</option>
                </select>
            </div>
            <div class="mx-3">
                <label for="">scegliere per voto</label>
                <select name="voto" id="" class="d-block">
                    <option selected='true' value="">tutti gli hotels</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">nome</th>
                <th scope="col">info</th>
                <th scope="col">parcheggio</th>
                <th scope="col">voto</th>
                <th scope="col">distanza dal centro</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($voto == '' && $parcheggio == '') {
                foreach ($hotels as $hotel){
                    echo "<tr>" . 
                        "<td>" . $hotel['name'] . "</td>" . 
                        "<td>" . $hotel['description'] . "</td>" . 
                        "<td>" . ($hotel['parking'] ? 'presente' : 'non presente') . "</td>" . 
                        "<td>" . $hotel['vote'] . "</td>" . 
                        "<td>" . $hotel['distance_to_center'] . "</td>" . 
                    "</tr>";
                };
            } elseif($parcheggio == '' && $voto != ''){
                foreach ($hotels as $hotel) {
                    if($hotel['vote'] >= $voto){
                        echo "<tr>" . 
                            "<td>" . $hotel['name'] . "</td>" . 
                            "<td>" . $hotel['description'] . "</td>" . 
                            "<td>" . ($hotel['parking'] ? 'presente' : 'non presente') . "</td>" . 
                            "<td>" . $hotel['vote'] . "</td>" . 
                            "<td>" . $hotel['distance_to_center'] . "</td>" . 
                        "</tr>";
                    };
                };
            } else{

                foreach ($filtroVoto as $hotel) {
                    echo "<tr>" . 
                        "<td>" . $hotel['name'] . "</td>" . 
                        "<td>" . $hotel['description'] . "</td>" . 
                        "<td>" . ($hotel['parking'] ? 'presente' : 'non presente') . "</td>" . 
                        "<td>" . $hotel['vote'] . "</td>" . 
                        "<td>" . $hotel['distance_to_center'] . "</td>" . 
                    "</tr>";
                };
            }
            ?>
        </tbody>
    </table>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>