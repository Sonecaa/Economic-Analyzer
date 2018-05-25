<?php
/** @package DbEca::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("TbFilesMap.php");

/**
 * TbFilesDAO provides object-oriented access to the tb_files table.  This
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
class TbFilesDAO extends Phreezable
{
	/** @var int */
	public $IdFile;

	/** @var string */
	public $StrNameFile;

	/** @var string */
	public $StrMonth;

	/** @var string */
	public $StrYear;


	/**
	 * Returns a dataset of TbPayments objects with matching TbFilesIdFile
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetFileTbPaymentss($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "fk_tb_payments_tb_files1", $criteria);
	}


}
?>