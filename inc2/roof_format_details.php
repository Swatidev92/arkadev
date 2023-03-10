<?php ?>
<table >
	<?php while( $row = $roofFetchDetailsQry->fetch_array() ){ ?>
	<tr><th colspan="4" style="text-align:left;background-color: #f2f2f2;">Tak/Yta <?=$k?></th></tr>
	<tr>
		<th>Antal paneler</th>
		<th>Takläggning</th>
		<th>Underlagstak</th>
		<th>Lutning</th>
	</tr>
	<tr>
		<td style="text-align: center;"><?php echo $row['total_panel']; ?></td>
		<td style="text-align: center;"><?php echo $row['roofing_material']; ?></td>
		<td style="text-align: center;"><?php if($row['roof_support'] == 1){ echo "Råspont"; }else{ echo "Ej Råspont"; } ?></td>
		<td style="text-align: center;"><?php echo $row['roof_angle']; ?>&#176;</td>
	</tr>
<?php $k++; } ?>

</table>