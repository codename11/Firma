<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Log In</h4>
        </div>
        <div class="modal-body">
			<form id="login" method="POST" action="modalLogIn.php">
			
				<div class="form-group">
					<label for="username">Korisničko ime:</label>
					<input type="text" name="username" class="form-control" id="username">
				</div>
				
				<div class="form-group">
					<label for="pwd">Šifra:</label>
					<input type="password" name="pwd" class="form-control" id="pwd">
				</div>	
			
			<button type="submit" id="logbtn" class="btn btn-default">Pošalji</button>
			</form>
			
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
  
</div>