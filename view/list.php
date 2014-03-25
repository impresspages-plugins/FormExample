<table class="table table-striped">
<?php
foreach ($products as $product){
?>
    <tr>
        <td><?php
            echo Plugin\FormExample\Model::showImage($product['imageFile']);
            ?></td>
        <td><?php echo $product['productName']; ?></td>
        <td><?php echo $product['dateSubmitted']; ?></td>
    </tr>
<?php
}
?>

</table>

<form>
    <input type="hidden" name="sa" value="FormExample.showForm"/>
    <button type="submit">Submit new product</button>
</form>