<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1 style="text-align: center">Trombinoscope</h1>

<?php foreach ($groupes_selected as $groupe) : ?>
    <h3 style="text-align: center">Groupe <?= $groupe->getLibelle() ?></h3>

	<table style="text-align:center" width="100%"  cellspacing="15" cellpading="8">
		<tbody>
			<tr>
				<?php $compt = -1;
				foreach ($groupe->getEtudiants() as $etudiant) :
					$compt++;
					if($compt === 6) {
						echo '</tr><tr>';
						$compt=0;
					} ?>
					<td width="90">
						<span>
							<img src="<?= base_url(IMAGE_PATH . $etudiant->getPhoto()) ?>"/>
							<h4><?= $etudiant->getPrenom() . " " . $etudiant->getNom() ?></h4>
						</span>
					</td>
				<?php endforeach; ?>
			</tr>
		</tbody>
	</table>
<?php endforeach;




