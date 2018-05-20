<?php
/** @package    economic-analyzer::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/TbPayments.php");

/**
 * TbPaymentsController is the controller class for the TbPayments object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package economic-analyzer::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class TbPaymentsController extends AppBaseController
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
	 * Displays a list view of TbPayments objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for TbPayments records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new TbPaymentsCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('IdPayment,TbCityIdCity,TbFunctionsIdFunction,TbSubfunctionsIdSubfunction,TbProgramIdProgram,TbActionIdAction,TbBeneficiariesIdBeneficiaries,TbSourceIdSource,TbFilesIdFile,DbValue'
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

				$tbpaymentses = $this->Phreezer->Query('TbPayments',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $tbpaymentses->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $tbpaymentses->TotalResults;
				$output->totalPages = $tbpaymentses->TotalPages;
				$output->pageSize = $tbpaymentses->PageSize;
				$output->currentPage = $tbpaymentses->CurrentPage;
			}
			else
			{
				// return all results
				$tbpaymentses = $this->Phreezer->Query('TbPayments',$criteria);
				$output->rows = $tbpaymentses->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single TbPayments record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idPayment');
			$tbpayments = $this->Phreezer->Get('TbPayments',$pk);
			$this->RenderJSON($tbpayments, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new TbPayments record and render response as JSON
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

			$tbpayments = new TbPayments($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $tbpayments->IdPayment = $this->SafeGetVal($json, 'idPayment');

			$tbpayments->TbCityIdCity = $this->SafeGetVal($json, 'tbCityIdCity');
			$tbpayments->TbFunctionsIdFunction = $this->SafeGetVal($json, 'tbFunctionsIdFunction');
			$tbpayments->TbSubfunctionsIdSubfunction = $this->SafeGetVal($json, 'tbSubfunctionsIdSubfunction');
			$tbpayments->TbProgramIdProgram = $this->SafeGetVal($json, 'tbProgramIdProgram');
			$tbpayments->TbActionIdAction = $this->SafeGetVal($json, 'tbActionIdAction');
			$tbpayments->TbBeneficiariesIdBeneficiaries = $this->SafeGetVal($json, 'tbBeneficiariesIdBeneficiaries');
			$tbpayments->TbSourceIdSource = $this->SafeGetVal($json, 'tbSourceIdSource');
			$tbpayments->TbFilesIdFile = $this->SafeGetVal($json, 'tbFilesIdFile');
			$tbpayments->DbValue = $this->SafeGetVal($json, 'dbValue');

			$tbpayments->Validate();
			$errors = $tbpayments->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbpayments->Save();
				$this->RenderJSON($tbpayments, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing TbPayments record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idPayment');
			$tbpayments = $this->Phreezer->Get('TbPayments',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $tbpayments->IdPayment = $this->SafeGetVal($json, 'idPayment', $tbpayments->IdPayment);

			$tbpayments->TbCityIdCity = $this->SafeGetVal($json, 'tbCityIdCity', $tbpayments->TbCityIdCity);
			$tbpayments->TbFunctionsIdFunction = $this->SafeGetVal($json, 'tbFunctionsIdFunction', $tbpayments->TbFunctionsIdFunction);
			$tbpayments->TbSubfunctionsIdSubfunction = $this->SafeGetVal($json, 'tbSubfunctionsIdSubfunction', $tbpayments->TbSubfunctionsIdSubfunction);
			$tbpayments->TbProgramIdProgram = $this->SafeGetVal($json, 'tbProgramIdProgram', $tbpayments->TbProgramIdProgram);
			$tbpayments->TbActionIdAction = $this->SafeGetVal($json, 'tbActionIdAction', $tbpayments->TbActionIdAction);
			$tbpayments->TbBeneficiariesIdBeneficiaries = $this->SafeGetVal($json, 'tbBeneficiariesIdBeneficiaries', $tbpayments->TbBeneficiariesIdBeneficiaries);
			$tbpayments->TbSourceIdSource = $this->SafeGetVal($json, 'tbSourceIdSource', $tbpayments->TbSourceIdSource);
			$tbpayments->TbFilesIdFile = $this->SafeGetVal($json, 'tbFilesIdFile', $tbpayments->TbFilesIdFile);
			$tbpayments->DbValue = $this->SafeGetVal($json, 'dbValue', $tbpayments->DbValue);

			$tbpayments->Validate();
			$errors = $tbpayments->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$tbpayments->Save();
				$this->RenderJSON($tbpayments, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing TbPayments record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idPayment');
			$tbpayments = $this->Phreezer->Get('TbPayments',$pk);

			$tbpayments->Delete();

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
