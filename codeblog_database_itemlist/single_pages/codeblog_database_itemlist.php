<div class="mountain-style">

    <?php
    if (isset($message)) {
        echo "<b>{$message}</b>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th><?php echo t('Name') ?></th>
                <th><?php echo t('Height') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mountains as $mountain) { ?>
                <tr>
                    <td><?php echo $mountain->getMountainName() ?></td>
                    <td><?php echo $mountain->getMountainHeight() ?></td>
                    <td><a href="<?php echo $this->action('remove', $mountain->getMountainID()) ?>"><?php echo t('remove') ?></a></td>
                </tr>
            <?php } ?>            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <?php echo $mountainsPagination ?>
                </td>
            </tr>
            <tr>
                <form method="post" action="<?php echo $this->action('add') ?>">
                    <td><input type="text" name="mountainName" value=""/></td>
                    <td><input type="text" name="mountainHeight" value=""/></td>
                    <td><input type="submit" value="<?php echo t('Add Mountain') ?>"/></td>
                </form>
            </tr>
        </tfoot>
    </table>

</div>