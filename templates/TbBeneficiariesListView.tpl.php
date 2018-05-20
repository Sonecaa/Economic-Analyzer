<?php
	$this->assign('title','economic-analyzer | TbBeneficiarieses');
	$this->assign('nav','tbbeneficiarieses');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/tbbeneficiarieses.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> TbBeneficiarieses
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="tbBeneficiariesCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdBeneficiaries">Id Beneficiaries<% if (page.orderBy == 'IdBeneficiaries') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrNis">Str Nis<% if (page.orderBy == 'StrNis') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrNamePerson">Str Name Person<% if (page.orderBy == 'StrNamePerson') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idBeneficiaries')) %>">
				<td><%= _.escape(item.get('idBeneficiaries') || '') %></td>
				<td><%= _.escape(item.get('strNis') || '') %></td>
				<td><%= _.escape(item.get('strNamePerson') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="tbBeneficiariesModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idBeneficiariesInputContainer" class="control-group">
					<label class="control-label" for="idBeneficiaries">Id Beneficiaries</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idBeneficiaries"><%= _.escape(item.get('idBeneficiaries') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strNisInputContainer" class="control-group">
					<label class="control-label" for="strNis">Str Nis</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strNis" placeholder="Str Nis" value="<%= _.escape(item.get('strNis') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strNamePersonInputContainer" class="control-group">
					<label class="control-label" for="strNamePerson">Str Name Person</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strNamePerson" placeholder="Str Name Person" value="<%= _.escape(item.get('strNamePerson') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTbBeneficiariesButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTbBeneficiariesButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete TbBeneficiaries</button>
						<span id="confirmDeleteTbBeneficiariesContainer" class="hide">
							<button id="cancelDeleteTbBeneficiariesButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTbBeneficiariesButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="tbBeneficiariesDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit TbBeneficiaries
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="tbBeneficiariesModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTbBeneficiariesButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="tbBeneficiariesCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTbBeneficiariesButton" class="btn btn-primary">Add TbBeneficiaries</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
