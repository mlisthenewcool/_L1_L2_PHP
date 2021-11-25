<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if (!empty ($csv_data)) : ?>

<div class="container">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width = "10%">Prénom</td>
            <td width = "20%">Nom</td>
            <td width = "20%">Groupe</td>
        </tr>

        <?php foreach($csv_data as $field) : ?>
            <tr>
                <td>
                    <?= $field['prenom']; ?>
                </td>
                <td>
                    <?= $field['nom']; ?>
                </td>
                <td>
                    <?= $field['groupe']; ?>
                </td>
            </tr>
        <?php endforeach;
        endif; ?>
    </table>
</div>