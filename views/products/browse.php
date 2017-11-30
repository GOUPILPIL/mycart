<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Parcourir les produits</title>
  </head>
  <body>
    <h1>produits</h1>
    <ul>
    <form action="" method="post">
    <button type="submit" value="1" name="pushtobakset">push</button>
    </form>
    <?php foreach ($products as $product): ?>
        <li>
          <a href="read.php?id=<?php echo $product['id']; ?>">
            <?php echo $product['title']; ?>
          </a>
        <br>
        <form action="" method="post">
        <button type="submit" value="<?php echo $product['id']; ?>" name="submit">ADD</button>
        <button type="submit" value="<?php echo $product['id']; ?>" name="delete">DELETE</button>
        </form>
        </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
