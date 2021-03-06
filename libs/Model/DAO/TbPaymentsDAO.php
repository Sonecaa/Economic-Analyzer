<?php
/** @package DbEca::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("TbPaymentsMap.php");

/**
 * TbPaymentsDAO provides object-oriented access to the tb_payments table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package DbEca::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class TbPaymentsDAO extends Phreezable
{
	/** @var int */
	public $IdPayment;

	/** @var int */
	public $TbCityIdCity;

	/** @var int */
	public $TbFunctionsIdFunction;

	/** @var int */
	public $TbSubfunctionsIdSubfunction;

	/** @var int */
	public $TbProgramIdProgram;

	/** @var int */
	public $TbActionIdAction;

	/** @var int */
	public $TbBeneficiariesIdBeneficiaries;

	/** @var int */
	public $TbSourceIdSource;

	/** @var int */
	public $TbFilesIdFile;

	/** @var double */
	public $DbValue;


	/**
	 * Returns the foreign object based on the value of TbActionIdAction
	 * @return TbAction
	 */
	public function GetActionTbAction()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_action1");
	}

	/**
	 * Returns the foreign object based on the value of TbBeneficiariesIdBeneficiaries
	 * @return TbBeneficiaries
	 */
	public function GetBeneficiariesTbBeneficiaries()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_beneficiaries1");
	}

	/**
	 * Returns the foreign object based on the value of TbCityIdCity
	 * @return TbCity
	 */
	public function GetCityTbCity()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_city1");
	}

	/**
	 * Returns the foreign object based on the value of TbFilesIdFile
	 * @return TbFiles
	 */
	public function GetFileTbFiles()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_files1");
	}

	/**
	 * Returns the foreign object based on the value of TbFunctionsIdFunction
	 * @return TbFunctions
	 */
	public function GetFunctionTbFunctions()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_functions1");
	}

	/**
	 * Returns the foreign object based on the value of TbProgramIdProgram
	 * @return TbProgram
	 */
	public function GetProgramTbProgram()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_program1");
	}

	/**
	 * Returns the foreign object based on the value of TbSourceIdSource
	 * @return TbSource
	 */
	public function GetSourceTbSource()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_source1");
	}

	/**
	 * Returns the foreign object based on the value of TbSubfunctionsIdSubfunction
	 * @return TbSubfunctions
	 */
	public function GetSubfunctionTbSubfunctions()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_tb_payments_tb_subfunctions1");
	}


}
?>