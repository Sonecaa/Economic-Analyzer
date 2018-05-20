<?php
/** @package    economic-analyzer::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/TbSource.php");

/**
 * TbSourceController is the controller class for the TbSource object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package economic-analyzer::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class TbSourceController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of TbSource objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for TbSource records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new TbSourceCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdSource,StrGoal,StrOrigin,StrPeriodicity'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$tbsources = $this->Phreezer->Query('TbSource',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $tbsources->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $tbsources->TotalResults;
				$output->totalPages = $tbsources->TotalPages;
				$output->pageSize = $tbsources->PageSize;
				$output->currentPage = $tbsources->CurrentPage;
			}
			else
			{
				// return all results
				$tbsources = $this->Phreezer->Query('TbSource',$criteria);
				$output->rows = $tbsources->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single TbSource record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idSource');
			$tbsource = $this->Phreezer->Get('TbSource',$pk);
			$this->RenderJSON($tbsource, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new TbSource record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$tbsource = new TbSource($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $tbsource->IdSource = $this->SafeGetVal($json, 'idSource');

			$tbsource->StrGoal = $this->SafeGetVal($json, 'strGoal');
			$tbsource->StrOrigin = $this->SafeGetVal($json, 'strOrigin');
			$tbsource->StrPeriodicity = $this->SafeGetVal($json, 'strPeriodicity');

			$tbsource->Validate();
			$errors = $tbsource->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbsource->Save();
				$this->RenderJSON($tbsource, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing TbSource record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idSource');
			$tbsource = $this->Phreezer->Get('TbSource',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $tbsource->IdSource = $this->SafeGetVal($json, 'idSource', $tbsource->IdSource);

			$tbsource->StrGoal = $this->SafeGetVal($json, 'strGoal', $tbsource->StrGoal);
			$tbsource->StrOrigin = $this->SafeGetVal($json, 'strOrigin', $tbsource->StrOrigin);
			$tbsource->StrPeriodicity = $this->SafeGetVal($json, 'strPeriodicity', $tbsource->StrPeriodicity);

			$tbsource->Validate();
			$errors = $tbsource->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbsource->Save();
				$this->RenderJSON($tbsource, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing TbSource record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idSource');
			$tbsource = $this->Phreezer->Get('TbSource',$pk);

			$tbsource->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
