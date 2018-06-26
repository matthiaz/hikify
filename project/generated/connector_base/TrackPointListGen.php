<?php

use QCubed\Query\Condition\ConditionInterface as QQCondition;
use QCubed\Query\Clause\ClauseInterface as QQClause;
use QCubed\Table\NodeColumn;
use QCubed\Project\Control\ControlBase as QControl;
use QCubed\Project\Control\FormBase as QForm;
use QCubed\Project\Control\Paginator;
use QCubed\Type;
use QCubed\Exception\Caller;
use QCubed\Query\QQ;


/**
 * This is the generated connector class for the List functionality
 * of the TrackPoint class.  This code-generated class
 * subclasses a TrackPoint class and can be used to display
 * a collection of TrackPoint objects.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create an instance of this object in a QForm or QPanel.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @property QQCondition 	$Condition Any condition to use during binding
 * @property QQClause 		$Clauses Any clauses to use during binding
 *
 */
class TrackPointListGen extends \QCubed\Project\Control\DataGrid
{
	/**
	 * @var null|QQCondition	Condition to use to filter the list.
	 * @access protected
	 */
	protected $objCondition;

	/**
	 * @var null|QQClause[]		Clauses to attach to the query.
	 * @access protected
	 */
	protected $objClauses;

	// Publicly accessible columns that allow parent controls to directly manipulate them after creation.
	/** @var NodeColumn */
	public $colId;
	/** @var NodeColumn */
	public $colTrack;
	/** @var NodeColumn */
	public $colPosition;
	/** @var NodeColumn */
	public $colType;
	/** @var NodeColumn */
	public $colName;


	/**
	 * QCubed\Project\Control\DataGrid constructor. The default creates a paginator, sets a default data binder, and sets the grid up
	 * watch the data. Columns are set up by the parent control. Feel free to override the constructor to do things differently.
	 *
	 * @param QControl|QForm $objParent
	 * @param null|string $strControlId
	 */
	public function __construct($objParent, $strControlId = null) 
	{
		parent::__construct($objParent, $strControlId);
		$this->createPaginator();
		$this->setDataBinder('bindData', $this);
		$this->watch(QQN::TrackPoint());
	}

	/**
	 * Creates the paginator. Override to add an additional paginator, or to remove it.
	 */
	protected function createPaginator() 
	{
		$this->Paginator = new Paginator($this);
		$this->ItemsPerPage = QCUBED_ITEMS_PER_PAGE;
	}
	/**
	 * Creates the columns for the table. Override to customize, or use the ModelConnectorEditor to turn on and off 
	 * individual columns. This is a public function and called by the parent control.
	 */
	public function createColumns() 
	{
		$this->colId = $this->createNodeColumn("Id", QQN::TrackPoint()->Id);
		$this->colTrack = $this->createNodeColumn("Track", QQN::TrackPoint()->Track);
		$this->colPosition = $this->createNodeColumn("Position", QQN::TrackPoint()->Position);
		$this->colType = $this->createNodeColumn("Type", QQN::TrackPoint()->Type);
		$this->colName = $this->createNodeColumn("Name", QQN::TrackPoint()->Name);
	}

   /**
	* Called by the framework to access the data for the control and load it into the table. By default, this function will be
	* the data binder for the control, with no additional conditions or clauses. To change what data is displayed in the list,
	* you have many options:
	* - Override this method in the Connector.
	* - Set ->Condition and ->Clauses properties for semi-permanent conditions and clauses
	* - Override the GetCondition and GetClauses methods in the Connector.
	* - For situations where the data might change every time you draw, like if the data is filtered by other controls,
	*   you should call SetDataBinder after the parent creates this control, and in your custom data binder, call this function,
	*   passing in the conditions and clauses you want this data binder to use.
	*
	*	This binder will automatically add the orderby and limit clauses from the paginator, if present.
	*
	* @param QQCondition|null $objAdditionalCondition
    * @param null|array $objAdditionalClauses
	*/
	public function bindData(QQCondition $objAdditionalCondition = null, $objAdditionalClauses = null) 
	{
		$objCondition = $this->getCondition($objAdditionalCondition);
		$objClauses = $this->getClauses($objAdditionalClauses);

		if ($this->Paginator) {
			$this->TotalItemCount = TrackPoint::queryCount($objCondition, $objClauses);
		}

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->OrderByClause) {
			$objClauses[] = $objClause;
		}

		// Add the LimitClause information, as well
		if ($objClause = $this->LimitClause) {
			$objClauses[] = $objClause;
		}

		$this->DataSource = TrackPoint::queryArray($objCondition, $objClauses);
	}

	/**
	 * Returns the condition to use when querying the data. Default is to return the condition put in the local
	 * objCondition member variable. You can also override this to return a condition. 
	 *
	 * @param QQCondition|null $objAdditionalCondition
	 * @return QQCondition
	 */
	protected function getCondition(QQCondition $objAdditionalCondition = null) 
	{
		// Get passed in condition, possibly coming from subclass or enclosing control or form
		$objCondition = $objAdditionalCondition;
		if (!$objCondition) {
			$objCondition = QQ::all();
		}
		// Get condition more permanently bound
		if ($this->objCondition) {
			$objCondition = QQ::andCondition($objCondition, $this->objCondition);
		}

		return $objCondition;
	}

	/**
	 * Returns the clauses to use when querying the data. Default is to return the clauses put in the local
	 * objClauses member variable. You can also override this to return clauses.
	 *
	 * @param array|null $objAdditionalClauses
	 * @return QQClause[]
	 */
	protected function getClauses($objAdditionalClauses = null) 
	{
		$objClauses = $objAdditionalClauses;
		if (!$objClauses) {
			$objClauses = [];
		}
		if ($this->objClauses) {
			$objClauses = array_merge($objClauses, $this->objClauses);
		}

		return $objClauses;
	}

	/**
	 * This will get the value of $strName
	 *
	 * @param string $strName Name of the property to get
	 * @return mixed
	 * @throws Caller
	 */
	public function __get($strName) 
	{
		switch ($strName) {
			case 'Condition':
				return $this->objCondition;
			case 'Clauses':
				return $this->objClauses;
			default:
				try {
					return parent::__get($strName);
				} catch (Caller $objExc) {
					$objExc->incrementOffset();
					throw $objExc;
				}
		}
	}

	/**
	 * This will set the property $strName to be $mixValue
	 *
	 * @param string $strName Name of the property to set
	 * @param string $mixValue New value of the property
	 * @return void
	 * @throws Caller
	 */
	public function __set($strName, $mixValue) 
	{
		switch ($strName) {
			case 'Condition':
				try {
					$this->objCondition = Type::cast($mixValue, '\QCubed\Query\Condition\ConditionInterface');
					$this->markAsModified();
				} catch (Caller $objExc) {
					$objExc->incrementOffset();
					throw $objExc;
				}
				break;
			case 'Clauses':
				try {
					$this->objClauses = Type::cast($mixValue, Type::ARRAY_TYPE);
					$this->markAsModified();
				} catch (Caller $objExc) {
					$objExc->incrementOffset();
					throw $objExc;
				}
				break;
			default:
				try {
					parent::__set($strName, $mixValue);
					break;
				} catch (Caller $objExc) {
					$objExc->incrementOffset();
					throw $objExc;
				}
		}
	}

}
