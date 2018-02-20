<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update/Izmena</h4>
        </div>
        <div class="modal-body">

          <div class="container-fluid text-center" style="font-family:Palatino Linotype;">
	<form method="POST" id="F1" class="vcenter" autocomplete="on">

		<div class="row">

			<div class="form-group col-sm-3">
		
				<label>Ime<span class="text-danger">*</span>:</label>
				<input type="text" id="imex" class="form-control text-center" maxlength="30" name="imex" placeholder="Ime" value=''>
			
			</div>
	
			<div class="form-group col-sm-3">
	
				<label>Prezime<span class="text-danger">*</span>:</label>
				<input type="text" id="prezimex" class="form-control text-center" maxlength="30" name="prezimex" placeholder="Prezime" value=''>
		
			</div>
			<div class="form-group col-sm-3">
		
				<label>Broj telefona<span class="text-danger">*</span>:</label>
				<input type="number" id="telx" class="form-control text-center" name="tel" min="0" oninput="javascript: if (this.value.length > this.maxLength) {alert('Ne može više od 10 cifara ...'); this.value = this.value.slice(0, this.maxLength);}"
				maxlength = "10" name="telx" placeholder="Unesite broj telefona ..."  value=''>
			
			</div>

		<div class="form-group col-sm-3">
		<label for="sel1">Kategorija:</label>
			<select class="form-control" id="selx">
				<option id="telx1" value="1">mobilni</option>
				<option id="telx2" value="2">fiksni</option>
			</select>
		</div>	
		</div>
		<button type="button" id="submit" style="margin-top: 10px" name="submit" class="btn btn-default" data-dismiss="modal" onclick='uzim_vredy("update_upit.php")'>Izmeni</button>	
	</form>
		
</div>
		  
        </div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
    </div>
</div>