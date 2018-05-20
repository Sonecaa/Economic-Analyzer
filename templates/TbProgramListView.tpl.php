<?php
	$this->assign('title','economic-analyzer | TbPrograms');
	$this->assign('nav','tbprograms');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/tbprograms.js").wait(function(){
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
	<i class="icon-th-list"></i> TbPrograms
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="tbProgramCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdProgram">Id Program<% if (page.orderBy == 'IdProgram') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrCodProgram">Str Cod Program<% if (page.orderBy == 'StrCodProgram') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrNameProgram">Str Name Program<% if (page.orderBy == 'StrNameProgram') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idProgram')) %>">
				<td><%= _.escape(item.get('idProgram') || '') %></td>
				<td><%= _.escape(item.get('strCodProgram') || '') %></td>
				<td><%= _.escape(item.get('strNameProgram') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="tbProgramModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idProgramInputContainer" class="control-group">
					<label class="control-label" for="idProgram">Id Program</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idProgram"><%= _.escape(item.get('idProgram') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strCodProgramInputContainer" class="control-group">
					<label class="control-label" for="strCodProgram">Str Cod Program</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strCodProgram" placeholder="Str Cod Program" value="<%= _.escape(item.get('strCodProgram') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strNameProgramInputContainer" class="control-group">
					<label class="control-label" for="strNameProgram">Str Name Program</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strNameProgram" placeholder="Str Name Program" value="<%= _.escape(item.get('strNameProgram') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTbProgramButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTbProgramButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete TbProgram</button>
						<span id="confirmDeleteTbProgramContainer" class="hide">
							<button id="cancelDeleteTbProgramButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTbProgramButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="tbProgramDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit TbProgram
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="tbProgramModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTbProgramButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="tbProgramCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTbProgramButton" class="btn btn-primary">Add TbProgram</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
