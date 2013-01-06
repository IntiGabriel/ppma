<h1>Requirements</h1>

<div class="form">
    <form>
        <h2>Environment</h2>
        <table class="setup req">
            <tr>
                <td>PHP-Version >= 5.2</td>
                <?php $value = $phpVersion ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
            <tr>
                <td>PDO is loaded</td>
                <?php $value = $pdoLoaded ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
            <tr>
                <td>
                    Function <code>str_getcsv()</code> is available<br />
                    (needed for import of CSV files, not mandatory)
                </td>
                <?php $value = $pdoLoaded ? 'true' : 'false'; ?>
                <td class="<?php echo $value ?>"><?php echo $value ?></td>
            </tr>
        </table>

        <h2>Permissions</h2>
        <table class="setup req">
            <?php foreach ($permissions as $path => $isWritable) : ?>
                <tr>
                    <td><?php echo $path ?></td>
                    <td class="<?php echo ($isWritable ? 'true' : 'false') ?>"><?php echo ($isWritable ? 'writable' : 'not writable') ?></td>
                </tr>
            <?php endforeach ?>
        </table>

        <?php if ($continue) : ?>
            <a class="setup" href="<?php echo $this->createUrl('setup/', array('step' => 2)) ?>">
                <?php echo CHtml::button('Next »', array('class' => 'button radius'))?>
            </a>
        <?php endif; ?>
    </form>
</div>