/**
 * backbone model definitions for economic-analyzer
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * TbAction Backbone Model
 */
model.TbActionModel = Backbone.Model.extend({
	urlRoot: 'api/tbaction',
	idAttribute: 'idAction',
	idAction: '',
	strCodAction: '',
	strNameAction: '',
	defaults: {
		'idAction': null,
		'strCodAction': '',
		'strNameAction': ''
	}
});

/**
 * TbAction Backbone Collection
 */
model.TbActionCollection = model.AbstractCollection.extend({
	url: 'api/tbactions',
	model: model.TbActionModel
});

/**
 * TbBeneficiaries Backbone Model
 */
model.TbBeneficiariesModel = Backbone.Model.extend({
	urlRoot: 'api/tbbeneficiaries',
	idAttribute: 'idBeneficiaries',
	idBeneficiaries: '',
	strNis: '',
	strNamePerson: '',
	defaults: {
		'idBeneficiaries': null,
		'strNis': '',
		'strNamePerson': ''
	}
});

/**
 * TbBeneficiaries Backbone Collection
 */
model.TbBeneficiariesCollection = model.AbstractCollection.extend({
	url: 'api/tbbeneficiarieses',
	model: model.TbBeneficiariesModel
});

/**
 * TbCity Backbone Model
 */
model.TbCityModel = Backbone.Model.extend({
	urlRoot: 'api/tbcity',
	idAttribute: 'idCity',
	idCity: '',
	strNameCity: '',
	strCodSiafiCity: '',
	tbStateIdState: '',
	defaults: {
		'idCity': null,
		'strNameCity': '',
		'strCodSiafiCity': '',
		'tbStateIdState': ''
	}
});

/**
 * TbCity Backbone Collection
 */
model.TbCityCollection = model.AbstractCollection.extend({
	url: 'api/tbcities',
	model: model.TbCityModel
});

/**
 * TbFiles Backbone Model
 */
model.TbFilesModel = Backbone.Model.extend({
	urlRoot: 'api/tbfiles',
	idAttribute: 'idFile',
	idFile: '',
	strNameFile: '',
	strMonth: '',
	strYear: '',
	defaults: {
		'idFile': null,
		'strNameFile': '',
		'strMonth': '',
		'strYear': ''
	}
});

/**
 * TbFiles Backbone Collection
 */
model.TbFilesCollection = model.AbstractCollection.extend({
	url: 'api/tbfileses',
	model: model.TbFilesModel
});

/**
 * TbFunctions Backbone Model
 */
model.TbFunctionsModel = Backbone.Model.extend({
	urlRoot: 'api/tbfunctions',
	idAttribute: 'idFunction',
	idFunction: '',
	strCodFunction: '',
	strNameFunction: '',
	defaults: {
		'idFunction': null,
		'strCodFunction': '',
		'strNameFunction': ''
	}
});

/**
 * TbFunctions Backbone Collection
 */
model.TbFunctionsCollection = model.AbstractCollection.extend({
	url: 'api/tbfunctionses',
	model: model.TbFunctionsModel
});

/**
 * TbPayments Backbone Model
 */
model.TbPaymentsModel = Backbone.Model.extend({
	urlRoot: 'api/tbpayments',
	idAttribute: 'idPayment',
	idPayment: '',
	tbCityIdCity: '',
	tbFunctionsIdFunction: '',
	tbSubfunctionsIdSubfunction: '',
	tbProgramIdProgram: '',
	tbActionIdAction: '',
	tbBeneficiariesIdBeneficiaries: '',
	tbSourceIdSource: '',
	tbFilesIdFile: '',
	dbValue: '',
	defaults: {
		'idPayment': null,
		'tbCityIdCity': '',
		'tbFunctionsIdFunction': '',
		'tbSubfunctionsIdSubfunction': '',
		'tbProgramIdProgram': '',
		'tbActionIdAction': '',
		'tbBeneficiariesIdBeneficiaries': '',
		'tbSourceIdSource': '',
		'tbFilesIdFile': '',
		'dbValue': ''
	}
});

/**
 * TbPayments Backbone Collection
 */
model.TbPaymentsCollection = model.AbstractCollection.extend({
	url: 'api/tbpaymentses',
	model: model.TbPaymentsModel
});

/**
 * TbProgram Backbone Model
 */
model.TbProgramModel = Backbone.Model.extend({
	urlRoot: 'api/tbprogram',
	idAttribute: 'idProgram',
	idProgram: '',
	strCodProgram: '',
	strNameProgram: '',
	defaults: {
		'idProgram': null,
		'strCodProgram': '',
		'strNameProgram': ''
	}
});

/**
 * TbProgram Backbone Collection
 */
model.TbProgramCollection = model.AbstractCollection.extend({
	url: 'api/tbprograms',
	model: model.TbProgramModel
});

/**
 * TbRegion Backbone Model
 */
model.TbRegionModel = Backbone.Model.extend({
	urlRoot: 'api/tbregion',
	idAttribute: 'idRegion',
	idRegion: '',
	strNameRegion: '',
	defaults: {
		'idRegion': null,
		'strNameRegion': ''
	}
});

/**
 * TbRegion Backbone Collection
 */
model.TbRegionCollection = model.AbstractCollection.extend({
	url: 'api/tbregions',
	model: model.TbRegionModel
});

/**
 * TbSource Backbone Model
 */
model.TbSourceModel = Backbone.Model.extend({
	urlRoot: 'api/tbsource',
	idAttribute: 'idSource',
	idSource: '',
	strGoal: '',
	strOrigin: '',
	strPeriodicity: '',
	defaults: {
		'idSource': null,
		'strGoal': '',
		'strOrigin': '',
		'strPeriodicity': ''
	}
});

/**
 * TbSource Backbone Collection
 */
model.TbSourceCollection = model.AbstractCollection.extend({
	url: 'api/tbsources',
	model: model.TbSourceModel
});

/**
 * TbState Backbone Model
 */
model.TbStateModel = Backbone.Model.extend({
	urlRoot: 'api/tbstate',
	idAttribute: 'idState',
	idState: '',
	strUf: '',
	strName: '',
	tbRegionIdRegion: '',
	defaults: {
		'idState': null,
		'strUf': '',
		'strName': '',
		'tbRegionIdRegion': ''
	}
});

/**
 * TbState Backbone Collection
 */
model.TbStateCollection = model.AbstractCollection.extend({
	url: 'api/tbstates',
	model: model.TbStateModel
});

/**
 * TbSubfunctions Backbone Model
 */
model.TbSubfunctionsModel = Backbone.Model.extend({
	urlRoot: 'api/tbsubfunctions',
	idAttribute: 'idSubfunction',
	idSubfunction: '',
	strCodSubfunction: '',
	strNameSubfunction: '',
	defaults: {
		'idSubfunction': null,
		'strCodSubfunction': '',
		'strNameSubfunction': ''
	}
});

/**
 * TbSubfunctions Backbone Collection
 */
model.TbSubfunctionsCollection = model.AbstractCollection.extend({
	url: 'api/tbsubfunctionses',
	model: model.TbSubfunctionsModel
});

