<!--  Developed by julián González Bucheli
bootstrapCDN https://getbootstrap.com and then download then CDN via jsDeliver and copy links -->
<?php include "header.php";
include "db_connection1.php"; 
include "sessions.php";
include "nobackpage.php";
?>

<script>
	function openList(evt, cityName) {
		// Declare all variables
		var i, tabcontent, tablinks;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the link that opened the tab
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";
	}
	</script>
	
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>	
	
    <script> $(document).ready( function () {
        $('#autosearch').DataTable();
       } );</script>  <!-- to apply the external file style to the tables-->

<div class="container p-4">

	<div class="row">
		<div class="col-md-4">
		     <?php  if(isset($_SESSION['message'])) {?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>				
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
			 <?php  session_unset();}?>
		  
			<div class="card card-body">
				<form action="savelinks.php" method="POST"> 
				
					<div class="form-group">
						<label for="videolink" style="color: black;"><strong>Video URL full link</strong></label><br>	
						<textarea name="videolink" rows="5" class="form-control" placeholder="Video URL full link"></textarea> <br>
					</div>
					<div class="form-group">
					<label for="videolink" style="color: black;"><strong>Main Category</strong></label><br>	
						<select name= "maincategory" required> <?php $SQLSELECT = "SELECT * FROM videotips_maincategory order by maincategory asc"; $result_set = mysqli_query($conn, $SQLSELECT); while ($rows = $result_set ->fetch_assoc()) { $maincategory = $rows['maincategory']; echo "<option value='$maincategory'>$maincategory</option>";} ?></select> <br><br>
					</div>
					<div class="form-group">
					<label for="videolink" style="color: black;"><strong>Secondary Category </strong></label><br>	
						<select name= "category" required > <?php $SQLSELECT = "SELECT * FROM videotips_viodetipscategory order by category asc"; $result_set =  mysqli_query($conn, $SQLSELECT); while ($rows = $result_set ->fetch_assoc()) { $category = $rows['category']; echo "<option value='$category'>$category</option>";} ?></select> <br><br>
					</div>
	                 <div class="form-group">
					 	<label for="videolink" style="color: black;"><strong>Description</strong></label><br>	
						<textarea name="description" rows="5" class="form-control" placeholder="Video tip Description"></textarea> <br>
					</div>  	
					<input type="submit" class="btn btn-success btn-block" name="save_linkk" value="Save Link"></input>
					<input type="submit" class="btn btn-success btn-block" name="logout" value="Logout" formaction="//localhost"></input>
					<input type="submit" class="btn btn-success btn-block" name="logout" value="Refresh" formaction="videolinkadminmodule.php"></input>
				</form>
			</div>
		</div>
		
		<div class="col-md-8">
			<table class="table table-bordered">
				<thead>
				   <tr>
				      <th>Video Link</th>
					  <th>Category</th>
					  <th>Sub Category</th>
					  <th>Description</th>
					  <th>Active</th>
				   </tr>
			    </thead>
				<tbody>
					<?php 
					$query1 = "select * from videotips_videotips where active = 'Yes' and username = '$usernamer' order by maincategory, category";
					$result_links = mysqli_query($conn,$query1);
					while($links = mysqli_fetch_array($result_links)) { ?>
					  <tr>
						<td><?php echo $links['videolink'] ?></td>
						<td><?php echo $links['maincategory'] ?></td>
						<td><?php echo $links['category'] ?></td>
						<td><?php echo $links['description'] ?></td>
						<td><?php echo $links['active'] ?></td>
						<td><a href="edit.php?videolink=<?php echo $links['videolink']?>"class="btn btn-secondary"><i class="fas fa-marker"></i></a>
						    <a href="delete.php?videolink=<?php echo $links['videolink']?>"class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
						</td>
					  </tr>
					<?php }?>
				<tbody>
			</table>
		</div>
	</div>
</div>

<?php include ("footer.php")?>

 