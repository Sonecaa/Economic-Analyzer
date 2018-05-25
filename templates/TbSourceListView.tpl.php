<?php
	$this->assign('title','economic-analyzer | TbSources');
	$this->assign('nav','tbsources');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/tbsources.js").wait(function(){
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
	<i class="icon-th-list"></i> TbSources
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="tbSourceCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_IdSource">Id Source<% if (page.orderBy == 'IdSource') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrGoal">Str Goal<% if (page.orderBy == 'StrGoal') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrOrigin">Str Origin<% if (page.orderBy == 'StrOrigin') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_StrPeriodicity">Str Periodicity<% if (page.orderBy == 'StrPeriodicity') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('idSource')) %>">
				<td><%= _.escape(item.get('idSource') || '') %></td>
				<td><%= _.escape(item.get('strGoal') || '') %></td>
				<td><%= _.escape(item.get('strOrigin') || '') %></td>
				<td><%= _.escape(item.get('strPeriodicity') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="tbSourceModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idSourceInputContainer" class="control-group">
					<label class="control-label" for="idSource">Id Source</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="idSource"><%= _.escape(item.get('idSource') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strGoalInputContainer" class="control-group">
					<label class="control-label" for="strGoal">Str Goal</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strGoal" placeholder="Str Goal" value="<%= _.escape(item.get('strGoal') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strOriginInputContainer" class="control-group">
					<label class="control-label" for="strOrigin">Str Origin</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strOrigin" placeholder="Str Origin" value="<%= _.escape(item.get('strOrigin') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="strPeriodicityInputContainer" class="control-group">
					<label class="control-label" for="strPeriodicity">Str Periodicity</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="strPeriodicity" placeholder="Str Periodicity" value="<%= _.escape(item.get('strPeriodicity') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteTbSourceButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteTbSourceButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete TbSource</button>
						<span id="confirmDeleteTbSourceContainer" class="hide">
							<button id="cancelDeleteTbSourceButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteTbSourceButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="tbSourceDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit TbSource
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="tbSourceModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveTbSourceButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="tbSourceCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newTbSourceButton" class="btn btn-primary">Add TbSource</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
