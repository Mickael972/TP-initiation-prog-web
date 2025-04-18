<?php
    //récupération du paramètre who dans l'url
    $who = isset($_GET['who']) ? $_GET['who'] : null;

    // Tableau d'images des personnes
    $images = [
        'Anne' => 'https://www.planetegrandesecoles.com/wp-content/uploads/2023/08/anne.jpg.webp',
        'Eva' => 'https://upload.wikimedia.org/wikipedia/commons/3/30/EVA_GREEN_CESAR_2020.jpg',
    ];

    // vérifie si la personne est dans le tableau d'images
    $displayImage = isset($images[$who]) ? $images[$who] : null;

    // si la personne exciste, on affiche l'image, sinon on affiche un message d'erreur
    if(isset($images[$who])){
        $displayImage = $images[$who];
        $errormessage = null;
    } else {
        $displayImage = null;
        $errormessage = "La personne '$who' n'existe pas !";
    }


    

    
    class Product {
        public function __construct(
            public string $title,
            public string $color,
            public int $price,
            public string $image
        ) {
        }
    }

    $productCollection = [
        new Product ('Perfecto cuir', 'noir', 20000, 'https://img.la-canadienne.com/0b724ed59c83f6e284c0359289845c95.jpg?w=303&h=485'),
        new Product ('Kway nylon', 'bleu marine', 12000, 'https://img.la-canadienne.com/a4d8eaa6e8d757ef0d1c567ffe046dd3.jpg?w=303&h=485'),
        new Product ('Doudoune fourrure', 'taupe', 80000, 'https://img.la-canadienne.com/b06d909825c356b67626407c926e8b83.jpg?w=303&h=485'),
    ];

    // on recupere le paramètre productId dans l'url 
    $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
    $selectedProduct = null;
    $productErrorMessage = null;

    //on vérifie si le produit existe si oui on l'affiche sinon on affiche un message d'erreur
    if(!is_null($productId)) {
        if (isset($productCollection[$productId])) {
            $selectedProduct = $productCollection[$productId];
            $productErrorMessage = null;
        } else {
            $productErrorMessage = "Le produit '$productId' n'existe pas !";
        }
    }




?>
<html>
    <header>
        <title>PHP</title>
        <h1>Bonjour <?=$who?> !</h1>
    </header>
    <body>
        <ul>
            <li><a href="main.php?who=Anne">Anne</a></li>
            <li><a href="main.php?who=Eva">Eva</a></li>
        </ul>
        <div>
            <?php if ($displayImage): ?>
                <p>Voici l'image d' <?= htmlspecialchars($who) ?> :</p>
            <img src="<?= htmlspecialchars($displayImage) ?>" alt="Image de <?= htmlspecialchars($who) ?>" width="200" height="200">
            <?php else: ?>
                <p style="color=red;"><?= htmlspecialchars($errormessage) ?></p>
            <?php endif; ?>
        </div>

        <h2>Listes des produits</h2>
        <ul>
            <?php foreach ($productCollection as $index => $product): ?>
                <li><a href="main.php?productId=<?= $index ?>"><?= htmlspecialchars($product->title) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <div>
            <?php if ($selectedProduct): ?>
                <p>Voici le produit sélectionné :</p>
                <p>Titre : <?= htmlspecialchars($selectedProduct->title) ?></p>
                <p>Couleur : <?= htmlspecialchars($selectedProduct->color) ?></p>
                <p>Prix : <?= htmlspecialchars($selectedProduct->price) ?> €</p>
                <img src="<?= htmlspecialchars($selectedProduct->image) ?>" alt="Image de <?= htmlspecialchars($selectedProduct->title) ?>" width="300" height="300">
            <?php elseif (!empty($productErrorMessage)): ?>
                <p style="color=red;"><?= htmlspecialchars($productErrorMessage) ?></p>
            <?php endif; ?>
    </body>
</html>