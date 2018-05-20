<?php
/** @package    economic-analyzer::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/TbBeneficiaries.php");

/**
 * TbBeneficiariesController is the controller class for the TbBeneficiaries object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package economic-analyzer::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class TbBeneficiariesController extends AppBaseController
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
	 * Displays a list view of TbBeneficiaries objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for TbBeneficiaries records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new TbBeneficiariesCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdBeneficiaries,StrNis,StrNamePerson'
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

				$tbbeneficiarieses = $this->Phreezer->Query('TbBeneficiaries',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $tbbeneficiarieses->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $tbbeneficiarieses->TotalResults;
				$output->totalPages = $tbbeneficiarieses->TotalPages;
				$output->pageSize = $tbbeneficiarieses->PageSize;
				$output->currentPage = $tbbeneficiarieses->CurrentPage;
			}
			else
			{
				// return all results
				$tbbeneficiarieses = $this->Phreezer->Query('TbBeneficiaries',$criteria);
				$output->rows = $tbbeneficiarieses->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single TbBeneficiaries record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idBeneficiaries');
			$tbbeneficiaries = $this->Phreezer->Get('TbBeneficiaries',$pk);
			$this->RenderJSON($tbbeneficiaries, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new TbBeneficiaries record and render response as JSON
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

			$tbbeneficiaries = new TbBeneficiaries($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $tbbeneficiaries->IdBeneficiaries = $this->SafeGetVal($json, 'idBeneficiaries');

			$tbbeneficiaries->StrNis = $this->SafeGetVal($json, 'strNis');
			$tbbeneficiaries->StrNamePerson = $this->SafeGetVal($json, 'strNamePerson');

			$tbbeneficiaries->Validate();
			$errors = $tbbeneficiaries->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbbeneficiaries->Save();
				$this->RenderJSON($tbbeneficiaries, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing TbBeneficiaries record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idBeneficiaries');
			$tbbeneficiaries = $this->Phreezer->Get('TbBeneficiaries',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $tbbeneficiaries->IdBeneficiaries = $this->SafeGetVal($json, 'idBeneficiaries', $tbbeneficiaries->IdBeneficiaries);

			$tbbeneficiaries->StrNis = $this->SafeGetVal($json, 'strNis', $tbbeneficiaries->StrNis);
			$tbbeneficiaries->StrNamePerson = $this->SafeGetVal($json, 'strNamePerson', $tbbeneficiaries->StrNamePerson);

			$tbbeneficiaries->Validate();
			$errors = $tbbeneficiaries->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbbeneficiaries->Save();
				$this->RenderJSON($tbbeneficiaries, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing TbBeneficiaries record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idBeneficiaries');
			$tbbeneficiaries = $this->Phreezer->Get('TbBeneficiaries',$pk);

			$tbbeneficiaries->Delete();

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
