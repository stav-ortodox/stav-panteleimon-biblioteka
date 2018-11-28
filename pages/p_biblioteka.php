<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/s_connect.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/s_app_config.php';  
require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/s_functions.php';

get_header_site ('Библиотека', 'Электронная библиотека храма святого Великомученика и Целителя Пантелеимона <br> г. Ставрополь');
get_menu ();
// get_sidebar ();
page_title ('Издательство нашего храма');


$select_query = sprintf("SELECT * FROM publishing_blocks");

echo "
<div class='container-fluid'>
	<div class='row'> 
		<div class='col-10'> ";


$result = mysqli_query($link, $select_query);
while ($row = mysqli_fetch_array($result)) {
 // выводим данные

			if ($_SESSION['id'] == 1) {  #Для админа

			$hidden = $row['block_hidden'];
			$edit = "<a href= /pages/biblioteka/p_edit_publisher_block.php?id=".$row["id"].">Редактировать</a>";
			$delete = "<a href= /pages/biblioteka/s_delete_publisher_block.php?id=".$row["id"].">Удалить блок</a>";
							
							if ($hidden == 0) {
								$no_error = 'блок открыт';
								$color = "color: green";
							}

							if ($hidden == 1) {
								$no_error = 'блок скрыт';
								$color = "color: red";
							}
			   }

			if ($_SESSION['id'] == null or $_SESSION['id'] > 1) {

			$hidden = $row['block_hidden'];
			

							if ($hidden == 0) {
								$color = "display: none";
							}

							else {
							 continue(1);
							}
						}


				echo "
					<div class='row col-lg-4 col-md-4 col-sm-6 col-xs-12'>
					<div class='no_error' style='".$color."'>".$no_error."<br>".$edit."<br>".$delete."</div>
						<div class='prew-block'>
						
						
							<a href='/pages/biblioteka/p_publishing_page.php?id=".$row["id"]."'>
								<h4>".$row["block_name"]."</h4>
								<hr>
								<img src=/".$row["block_image"]." alt=''>
								<h5>".$row["block_description"]."</h5>
							</a>	
						</div> 
					</div>";
}
			
						
				
echo "
</div>
";


 

if ($_SESSION['id'] == 1)
	echo	'
			<div class="col-2"> 
				<div class="sidebar">
					<h3>Панель администратора</h3>
					<hr>
					<ul>
						<li><a href="/pages/admins/p_admin_add_new_publishing_block.php">Добавить новый блок издания</a></li><br>
						<li><a href="/pages/admins/p_admin_add_new_publishing_post.php">Добавить новое издание в существующий блок издания</a></li>
					</ul>
				</div>
			</div>';		

?>


	</div> <!-- строка контент-сайдбар -->
</div><!-- container-fluid -->


<?php
get_footer ();
?>