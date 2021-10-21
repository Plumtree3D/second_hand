<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> zertyui </title>
</head>

<body>

<?php require_once 'class/class.postings.php' ?>

<h1> postings </h1>
<table>
    <thead>
        <tr>
            <th> # </th>
            <th>title</th>
            <th>category</th>
            <th>description</th>
            <th>price</th>
            <th>location</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $select = new Posting();
    $select = $select->select();
    foreach($select as $truc) : 
    ?>
                            <tr>
                                <td> <?php echo $truc['posting_id']; ?> </td>
                                <td> <?php echo $truc['posting_title']; ?> </td>
                                <td> <?php echo $truc['posting_cat']; ?> </td>
                                <td> <?php echo $truc['posting_desc']; ?> </td>
                                <td> <?php echo $truc['posting_price']; ?> </td>
                                <td> <?php echo $truc['posting_loc']; ?> </td>
                            </tr>
    <?php endforeach ?>
    </tbody>
</table>
    
</body>
</html>