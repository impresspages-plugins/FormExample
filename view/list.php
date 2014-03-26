<table>
    <?php
    foreach ($images as $image) {
        ?>
        <tr>
            <td><?php
                echo Plugin\FormExample\Model::showImage($image['imageFile']);
                ?></td>
            <td><?php echo esc($image['imageTitle']); ?></td>
            <td><?php echo __(' by ', 'FormExample') . esc($image['personName']); ?></td>
            <td><?php echo ipFormatDateTime(strtotime($image['dateSubmitted']), 'Ip'); ?></td>
        </tr>
    <?php
    }
    ?>

</table>

<form>
    <input type="hidden" name="sa" value="FormExample.showForm"/>
    <button type="submit"><?php echo __('Submit new image', 'FormExample'); ?></button>
</form>