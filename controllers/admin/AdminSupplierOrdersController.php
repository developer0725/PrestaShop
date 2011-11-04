<?php
/*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 9565 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @since 1.5.0
 */
class AdminSupplierOrdersControllerCore extends AdminController
{
	public function __construct()
	{
		$this->context = Context::getContext();
	 	$this->table = 'supplier_order_state';
	 	$this->className = 'SupplierOrderState';
	 	$this->colorOnBackground = true;
		$this->lang = true;

		$this->fieldsDisplay = array(
			'name' => array(
				'title' => $this->l('Name'),
			),
			'editable' => array(
				'title' => $this->l('Editable?'),
				'align' => 'center',
				'icon' => array(
					'1' => 'enabled.gif',
					'0' => 'disabled.gif'
				),
				'type' => 'bool',
				'width' => 170,
				'orderby' => false
			),
			'delivery_note' => array(
				'title' => $this->l('Delivery note available?'),
				'align' => 'center',
				'icon' => array(
					'1' => 'enabled.gif',
					'0' => 'disabled.gif'
				),
				'type' => 'bool',
				'width' => 170,
				'orderby' => false
			),
			'pending_receipt' => array(
				'title' => $this->l('Is a pending receipt state?'),
				'align' => 'center',
				'icon' => array(
					'1' => 'enabled.gif',
					'0' => 'disabled.gif'
				),
				'type' => 'bool',
				'width' => 170,
				'orderby' => false
			),
			'receipt_state' => array(
				'title' => $this->l('Is a delivery state?'),
				'align' => 'center',
				'icon' => array(
					'1' => 'enabled.gif',
					'0' => 'disabled.gif'
				),
				'type' => 'bool',
				'width' => 170,
				'orderby' => false
			),
			'enclosed' => array(
				'title' => $this->l('Is an enclosed order state?'),
				'align' => 'center',
				'icon' => array(
					'1' => 'enabled.gif',
					'0' => 'disabled.gif'
				),
				'type' => 'bool',
				'width' => 170,
				'orderby' => false
			),
		);

		parent::__construct();
	}

	/**
	 * AdminController::init() override
	 * @see AdminController::init()
	 */
	public function init()
	{
		parent::init();

		if (Tools::isSubmit('addsupplier_order') ||
			Tools::isSubmit('submitAddsupplier_order') ||
			(Tools::isSubmit('updatesupplier_order') && Tools::isSubmit('id_supplier_order')))
		{
			// override table, land, className and identifier for the current controller
		 	$this->table = 'supplier_order';
		 	$this->className = 'SupplierOrder';
		 	$this->identifier = 'id_supplier_order';
		 	$this->lang = false;

			$this->action = 'new';
			$this->display = 'add';

			if (Tools::isSubmit('updatesupplier_order'))
				if ($this->tabAccess['edit'] === '1')
					$this->display = 'edit';
				else
					$this->_errors[] = Tools::displayError('You do not have permission to edit here.');
		}
	}

	/**
	 * AdminController::initForm() override
	 * @see AdminController::initForm()
	 */
	public function initForm()
	{
		if (Tools::isSubmit('addsupplier_order_state'))
		{
			$this->fields_form = array(
				'legend' => array(
					'title' => $this->l('Supplier Order State'),
					'image' => '../img/admin/edit.gif'
				),
				'input' => array(
					array(
						'type' => 'text',
						'lang' => true,
						'attributeLang' => 'name',
						'label' => $this->l('Name:'),
						'name' => 'name',
						'size' => 50,
						'required' => true
					),
					array(
						'type' => 'color',
						'label' => $this->l('Back office color:'),
						'name' => 'color',
						'size' => 20,
						'p' => $this->l('Back office background will be displayed in this color. HTML colors only (e.g.,').' "lightblue", "#CC6600")'
					),
					array(
						'type' => 'radio',
						'label' => $this->l('Is the order editable in this state?:'),
						'name' => 'editable',
						'required' => true,
						'class' => 't',
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Yes')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('No')
							)
						),
						'p' => $this->l('You have to define if it is possible to edit the order in this state.
										An editable order is an order not valid to send to the supplier.')
					),
					array(
						'type' => 'radio',
						'label' => $this->l('Is the delivery note function is available in this state?:'),
						'name' => 'delivery_note',
						'required' => true,
						'class' => 't',
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Yes')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('No')
							)
						),
						'p' => $this->l('You have to define if it is possible to generate the delivery note of the order in this state.
										The order has to be valid to use this function.')
					),
					array(
						'type' => 'radio',
						'label' => $this->l('This state corresponds to a delivery state ?:'),
						'name' => 'receipt_state',
						'required' => true,
						'class' => 't',
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Yes')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('No')
							)
						),
						'p' => $this->l('You have to define if this state correspond to a product receipt on this order (partial or complete).
										This permit to know if the concerned products have to be added in stock.')
					),
					array(
						'type' => 'radio',
						'label' => $this->l('This state corresponds to a product pending receipt ?:'),
						'name' => 'pending_receipt',
						'required' => true,
						'class' => 't',
						'is_bool' => true,
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Yes')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('No')
							)
						),
						'p' => $this->l('You have to define if some products are pending receipt in this state.')
					),
				),
				'submit' => array(
					'title' => $this->l('   Save   '),
					'class' => 'button'
				)
			);

			return parent::initForm();
		}

		if (Tools::isSubmit('addsupplier_order') ||
			Tools::isSubmit('updatesupplier_order') ||
			Tools::isSubmit('submitAddsupplier_order') ||
			Tools::isSubmit('submitUpdatesupplier_order'))
		{
			$this->addJqueryUI('ui.datepicker');

			//get warehouses list
			$warehouses = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
				SELECT `id_warehouse`, CONCAT(`reference`, " - ", `name`) as name
				FROM `'._DB_PREFIX_.'warehouse`
				ORDER BY `reference` ASC');

			//get currencies list
			$currencies = Currency::getCurrencies();

			//get suppliers list
			$suppliers = Supplier::getSuppliers();

			$this->fields_form = array(
				'legend' => array(
					'title' => $this->l('Supplier Order Management'),
					'image' => '../img/admin/edit.gif'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Reference:'),
						'name' => 'reference',
						'size' => 50,
						'required' => true
					),
					array(
						'type' => 'select',
						'label' => $this->l('Supplier:'),
						'name' => 'id_supplier',
						'required' => true,
						'options' => array(
							'query' => $suppliers,
							'id' => 'id_supplier',
							'name' => 'name'
						),
						'p' => $this->l('Select the supplier associated to this order'),
						'hint' => $this->l('Be careful ! When changing this field, all products already associated with the order will be reseted.')
					),
					array(
						'type' => 'select',
						'label' => $this->l('Warehouse:'),
						'name' => 'id_warehouse',
						'required' => true,
						'options' => array(
							'query' => $warehouses,
							'id' => 'id_warehouse',
							'name' => 'name'
						),
						'p' => $this->l('Select the warehouse where you want to receive the products from this order'),
					),
					array(
						'type' => 'select',
						'label' => $this->l('Currency:'),
						'name' => 'id_currency',
						'required' => true,
						'options' => array(
							'query' => $currencies,
							'id' => 'id_currency',
							'name' => 'name'
						),
						'p' => $this->l('The currency of the order'),
						'hint' => $this->l('Be careful ! When changing this field, all products already associated with the order will be reseted.')
					),
					array(
						'type' => 'date',
						'label' => $this->l('Delivery date:'),
						'name' => 'date_delivery_expected',
						'size' => 20,
						'required' => true,
						'p' => $this->l('You can specify an expected delivery date for this order'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Global discount rate on this order:'),
						'name' => 'discount_rate',
						'size' => 5,
						'required' => true,
						'p' => $this->l('You can specify a global discount rate for the order'),
					),
				),
				'submit' => array(
					'title' => $this->l('   Save order modifications   '),
				)
			);

			return parent::initForm();
		}

	}

	/**
	 * AdminController::getList() override
	 * @see AdminController::getList()
	 */
	public function getList($id_lang, $order_by = null, $order_way = null, $start = 0, $limit = null, $id_lang_shop = false)
	{
		parent::getList($id_lang, $order_by, $order_way, $start, $limit, $id_lang_shop);

		// actions filters on supplier orders list
		if ($this->table == 'supplier_order')
		{
			$nb_items = count($this->_list);

			for ($i = 0; $i < $nb_items; $i++)
			{
				// if the current state doesn't allow order edit, skip the edit action
				if ($this->_list[$i]['editable'] == 0)
					$this->addRowActionSkipList('edit', $this->_list[$i]['id_supplier_order']);
				if ($this->_list[$i]['enclosed'] == 1)
					$this->addRowActionSkipList('changestate', $this->_list[$i]['id_supplier_order']);
			}
		}
	}

	/**
	 * AdminController::initList() override
	 * @see AdminController::initList()
	 */
	public function initList()
	{
		$this->displayInformation($this->l('This interface allows you to manage supplier orders.').'<br />');
		$this->displayInformation($this->l('Also, it allows you to add and edit your own supplier order states.'));

		// access
		if (!($this->tabAccess['add'] === '1'))
			unset($this->toolbar_btn['new']);

		//no link on list rows
		$this->list_no_link = true;

		/*
		 * Manage default list
		 */
		$this->addRowAction('edit');
		$this->addRowAction('delete');
		$this->addRowActionSkipList('edit', array(1, 2, 3, 4, 5, 6));
		$this->addRowActionSkipList('delete', array(1, 2, 3, 4, 5, 6));

		$first_list = '<hr /><h2>'.$this->l('Suppliers Orders States').'</h2>';
		$first_list .= parent::initList();

		/*
		 * Manage second list
		 */
		// reset actions, toolbar and query vars
		$this->actions = array();
		$this->list_skip_actions = array();
		$this->toolbar_btn = array();
		unset($this->_select, $this->_join, $this->_group, $this->_filterHaving, $this->_filter);

		// override table, land, className and identifier for the current controller
	 	$this->table = 'supplier_order';
	 	$this->className = 'SupplierOrder';
	 	$this->identifier = 'id_supplier_order';
	 	$this->lang = false;

		$this->addRowAction('edit');
		$this->addRowAction('changestate');
		$this->addRowAction('details');
		$this->addRowAction('view');

	 	// test if a filter is applied for this list
		if (Tools::isSubmit('submitFilter'.$this->table) || $this->context->cookie->{'submitFilter'.$this->table} !== false)
			$this->filter = true;

		// test if a filter reset request is required for this list
		if (isset($_POST['submitReset'.$this->table]))
			$this->action = 'reset_filters';
		else
			$this->action = '';

		// redifine fields display
		$this->fieldsDisplay = array(
			'reference' => array(
				'title' => $this->l('Order Reference'),
				'width' => 120,
				'havingFilter' => true
			),
			'employee' => array(
				'title' => $this->l('Employee'),
				'havingFilter' => true
			),
			'supplier' => array(
				'title' => $this->l('Supplier'),
				'width' => 200,
				'filter_key' => 's!name'
			),
			'warehouse' => array(
				'title' => $this->l('Warehouse'),
				'width' => 200,
				'filter_key' => 'w!name'
			),
			'state' => array(
				'title' => $this->l('State'),
				'width' => 150,
				'filter_key' => 'stl!name'
			),
			'date_add' => array(
				'title' => $this->l('Creation date'),
				'width' => 150,
				'align' => 'right',
				'type' => 'datetime',
				'havingFilter' => true,
				'filter_key' => 'a!date_add'
			),
			'date_upd' => array(
				'title' => $this->l('Last modification date'),
				'width' => 150,
				'align' => 'right',
				'type' => 'datetime',
				'havingFilter' => true,
				'filter_key' => 'a!date_upd'
			),
			'date_delivery_expected' => array(
				'title' => $this->l('Delivery date'),
				'width' => 150,
				'align' => 'right',
				'type' => 'datetime',
				'havingFilter' => true,
				'filter_key' => 'a!date_delivery_expected'
			),
			'id_pdf' => array(
				'title' => $this->l('PDF'),
				'width' => 50,
				'callback' => 'printPDFIcons',
				'orderby' => false,
				'search' => false
			),
		);

		// make new query
		$this->_select = '
			CONCAT(e.lastname, \' \', e.firstname) AS employee,
			s.name AS supplier,
			CONCAT(w.reference, \' \', w.name) AS warehouse,
			stl.name AS state,
			st.delivery_note,
			st.editable,
			st.enclosed,
			st.receipt_state,
			st.color AS color,
			a.id_supplier_order as id_pdf';

		$this->_join = 'LEFT JOIN `'._DB_PREFIX_.'supplier_order_state_lang` stl ON
						(
							a.id_supplier_order_state = stl.id_supplier_order_state
							AND stl.id_lang = '.(int)$this->context->language->id.'
						)
						LEFT JOIN `'._DB_PREFIX_.'supplier_order_state` st ON a.id_supplier_order_state = st.id_supplier_order_state
						LEFT JOIN `'._DB_PREFIX_.'supplier` s ON a.id_supplier = s.id_supplier
						LEFT JOIN `'._DB_PREFIX_.'warehouse` w ON (w.id_warehouse = a.id_warehouse)
						LEFT JOIN `'._DB_PREFIX_.'employee` e ON (e.id_employee = a.id_employee)';

		// call postProcess() for take care about actions and filters
		$this->postProcess();

		// init the toolbar according to the current list
		$this->initToolbar();

		// generate the second list
		$second_list = parent::initList();

		// reset all query vars
		unset($this->_select, $this->_join, $this->_group, $this->_filterHaving, $this->_filter);

		// return the two lists
		return $second_list.$first_list;
	}

	/**
	 * Init the content of change state action
	 */
	public function initChangeStateContent()
	{
		$id_supplier_order = (int)Tools::getValue('id_supplier_order', 0);

		if ($id_supplier_order <= 0)
		{
			$this->_errors[] = Tools::displayError('The specified supplier order is not valid');
			return parent::initContent();
		}

		$supplier_order = new SupplierOrder($id_supplier_order);
		if (!Validate::isLoadedObject($supplier_order))
		{
			$this->_errors[] = Tools::displayError('The specified supplier order is not valid');
			return parent::initContent();
		}

		// change the display type in order to add specific actions to
		$this->display = 'update_order_state';
		// overrides parent::initContent();
		$this->initToolbar();

		// given the current state, loads available states
		$states = SupplierOrderState::getSupplierOrderStates($supplier_order->id_supplier_order_state);
		// loads languages
		$this->getlanguages();

		// defines the fields of the form to display
		$this->fields_form = array(
			'legend' => array(
				'title' => $this->l('Supplier Order State'),
				'image' => '../img/admin/edit.gif'
			),
			'input' => array(
				array(
					'type' => 'hidden',
					'name' => 'id_supplier_order',
				),
				array(
					'type' => 'select',
					'label' => $this->l('New state of the order:'),
					'name' => 'id_supplier_order_state',
					'required' => true,
					'options' => array(
						'query' => $states,
						'id' => 'id_supplier_order_state',
						'name' => 'name'
					),
					'p' => $this->l('Choose the new state of your order')
				),
			),
			'submit' => array(
				'title' => $this->l('   Save   '),
				'class' => 'button'
			)
		);

		// sets up the helper
		$helper = new HelperForm();
		$helper->submit_action = 'submitChangestate';
		$helper->currentIndex = self::$currentIndex;
		$helper->toolbar_btn = $this->toolbar_btn;
		$helper->token = $this->token;
		$helper->id = null; // no display standard hidden field in the form
		$helper->languages = $this->_languages;
		$helper->default_form_language = $this->default_form_language;
		$helper->allow_employee_form_lang = $this->allow_employee_form_lang;
		$helper->fields_value = array(
			'id_supplier_order_state' => Tools::getValue('id_supplier', ''),
			'id_supplier_order' => $id_supplier_order,
		);

		// generates the form to display
		$this->content = $helper->generateForm($this->fields_form);

		// assigns our content
		$this->tpl_form_vars['show_change_state_form'] = true;
		$this->tpl_form_vars['state_content'] = $this->content;

		$this->context->smarty->assign(array(
			'content' => $this->content,
			'url_post' => self::$currentIndex.'&token='.$this->token,
		));
	}

	/**
	 * Init the content of change state action
	 */
	public function initUpdateSupplierOrderContent()
	{
		$this->addJqueryPlugin('autocomplete');

		// load supplier order
		$id_supplier_order = (int)Tools::getValue('id_supplier_order', null);

		if ($id_supplier_order != null)
		{
			$supplier_order = new SupplierOrder($id_supplier_order);

			if (Validate::isLoadedObject($supplier_order))
			{
				// load products of this order
				$products = $supplier_order->getEntriesCollection();

				$this->tpl_form_vars['products_list'] = $products;
				$this->tpl_form_vars['supplier_id'] = $supplier_order->id_supplier;
			}
		}
		$this->tpl_form_vars['content'] = $this->content;
		$this->tpl_form_vars['show_product_management_form'] = true;

		// first call parent initcontent to render standard form content
		parent::initContent();
	}

	/**
	 * AdminController::initContent() override
	 * @see AdminController::initContent()
	 */
	public function initContent()
	{
		// Manage the add stock form
		if (Tools::isSubmit('changestate'))
			$this->initChangeStateContent();
		else if (Tools::isSubmit('viewsupplier_order') && Tools::isSubmit('id_supplier_order'))
		{
			$this->display = 'view';
			$this->viewSupplierOrder();
			parent::initContent();
		}
		else if (Tools::isSubmit('updatesupplier_order'))
			$this->initUpdateSupplierOrderContent();
		else
			parent::initContent();
	}

	/**
	 * Ths method manage associated products to the order when updating it
	 */
	public function manageOrderProducts()
	{
		// loads supplier order
		$id_supplier_order = (int)Tools::getValue('id_supplier_order', null);

		if ($id_supplier_order != null)
		{
			$supplier_order = new SupplierOrder($id_supplier_order);

			if (Validate::isLoadedObject($supplier_order))
			{
				// tests if the supplier or currency have changed in the supplier order
				$new_supplier_id = (int)Tools::getValue('id_supplier');
				$new_currency_id = (int)Tools::getValue('id_currency');

				if (($new_supplier_id != $supplier_order->id_supplier) ||
					($new_currency_id != $supplier_order->id_currency))
				{
					// resets all products in this order
					$supplier_order->resetProducts();
				}
				else
				{
					// gets all product ids to manage
					$product_ids_str = Tools::getValue('product_ids', null);

					$product_ids = preg_split('/|/', $product_ids_str);

					// updates existing products ids
					foreach ($product_ids as $id)
					{
						$pos = strpos($id, '_');

						if ($pos === false)
							continue;

						// gets id_product and id_product attribute
						$id_product = substr($id, 0, $pos);
						$id_product_attribute = substr($id, $pos);
					}
				}
			}
		}
	}

	/**
	 * AdminController::postProcess() override
	 * @see AdminController::postProcess()
	 */
	public function postProcess()
	{
		// Checks access
		if (Tools::isSubmit('submitAddsupplier_order') && !($this->tabAccess['add'] === '1'))
			$this->_errors[] = Tools::displayError('You do not have the required permission to add a supplier order.');

		// Global checks when add / update a supplier order
		if (Tools::isSubmit('submitAddsupplier_order'))
		{
			$this->action = 'save';

			// get supplier ID
			$id_supplier = (int)Tools::getValue('id_supplier', 0);
			if ($id_supplier <= 0 || !Supplier::supplierExists($id_supplier))
				$this->_errors[] = Tools::displayError('The selected supplier is not valid.');

			// get warehouse id
			$id_warehouse = (int)Tools::getValue('id_warehouse', 0);
			if ($id_warehouse <= 0 || !Warehouse::exists($id_warehouse))
				$this->_errors[] = Tools::displayError('The selected warehouse is not valid.');

			// get currency id
			$id_currency = (int)Tools::getValue('id_currency', 0);
			if ($id_currency <= 0 || ( !($result = Currency::getCurrency($id_currency)) || empty($result) ))
				$this->_errors[] = Tools::displayError('The selected currency is not valid.');

			// specify employee
			$_POST['id_employee'] = $this->context->employee->id;

			// specify initial state
			$_POST['id_supplier_order_state'] = 1; //defaut creation state

			// specify global reference currency
			$_POST['id_ref_currency'] = $this->context->currency->id;

			// manage each associated product
			$this->manageOrderProducts();
		}

		// Manage state change
		if (Tools::isSubmit('submitChangestate')
			&& Tools::isSubmit('id_supplier_order')
			&& Tools::isSubmit('id_supplier_order_state'))
		{
			if ($this->tabAccess['edit'] != '1')
				$this->_errors[] = Tools::displayError('You do not have permissions to change order state.');

			// get state ID
			$id_state = (int)Tools::getValue('id_supplier_order_state', 0);
			if ($id_state <= 0)
				$this->_errors[] = Tools::displayError('The selected supplier order state is not valid.');

			// get supplier order ID
			$id_supplier_order = (int)Tools::getValue('id_supplier_order', 0);
			if ($id_supplier_order <= 0)
				$this->_errors[] = Tools::displayError('The supplier order id is not valid.');

			if (!count($this->_errors))
			{
				// try to load supplier order
				$supplier_order = new SupplierOrder($id_supplier_order);
				if (Validate::isLoadedObject($supplier_order))
				{
					// get valid available possible states for this order
					$states = SupplierOrderState::getSupplierOrderStates($supplier_order->id_supplier_order_state);

					foreach ($states as $state)
					{
						// if state is valid, change it in the order
						if ($id_state == $state['id_supplier_order_state'])
						{
							$supplier_order->id_supplier_order_state = $state['id_supplier_order_state'];
							if ($supplier_order->save())
							{
								$token = Tools::getValue('token') ? Tools::getValue('token') : $this->token;
								$redirect = self::$currentIndex.'&token='.$token;
								Tools::redirectAdmin($redirect.'&conf=5');
							}
						}
					}
				}
				else
					$this->_errors[] = Tools::displayError('The selected supplier is not valid.');
			}
		}

		parent::postProcess();
	}

    /**
	 * Display state action link
	 * @param string $token the token to add to the link
	 * @param int $id the identifier to add to the link
	 * @return string
	 */
    public function displayChangestateLink($token = null, $id)
    {
        if (!array_key_exists('State', self::$cache_lang))
            self::$cache_lang['State'] = $this->l('Change state');

        $this->context->smarty->assign(array(
            'href' => self::$currentIndex.
            	'&'.$this->identifier.'='.$id.
            	'&changestate&token='.($token != null ? $token : $this->token),
            'action' => self::$cache_lang['State'],
        ));

        return $this->context->smarty->fetch(_PS_ADMIN_DIR_.'/themes/template/helper/list/list_action_supplier_order_change_state.tpl');
    }

	/**
	 * method call when ajax request is made with the details row action
	 * @see AdminController::postProcess()
	 */
	public function ajaxProcess()
	{
		// tests if an id is submit
		if (Tools::isSubmit('id'))
		{
			// overrides attributes
			$this->identifier = 'id_supplier_order_history';
			$this->table = 'supplier_order_history';

			$this->display = 'list';
			$this->lang = false;
			// gets current lang id
			$lang_id = (int)$this->context->language->id;
			// gets supplier order id
			$id_supplier_order = (int)Tools::getValue('id');

			// creates new fieldsDisplay
			unset($this->fieldsDisplay);
			$this->fieldsDisplay = array(
				'history_date' => array(
					'title' => $this->l('Last update'),
					'width' => 50,
					'align' => 'left',
					'type' => 'datetime',
					'havingFilter' => true
				),
				'history_employee' => array(
					'title' => $this->l('Employee'),
					'width' => 100,
					'align' => 'left',
					'havingFilter' => true
				),
				'history_state_name' => array(
					'title' => $this->l('State'),
					'width' => 100,
					'align' => 'left',
					'havingFilter' => true
				),
			);
			// loads history of the given order
			unset($this->_select, $this->_join, $this->_where, $this->_orderBy, $this->_orderWay, $this->_group, $this->_filterHaving, $this->_filter);
			$this->_select = '
			a.`date_add` as history_date,
			CONCAT(e.`lastname`, \' \', e.`firstname`) as history_employee,
			sosl.`name` as history_state_name,
			sos.`color` as color';

			$this->_join = '
			LEFT JOIN `'._DB_PREFIX_.'supplier_order_state` sos ON (a.`id_state` = sos.`id_supplier_order_state`)
			LEFT JOIN `'._DB_PREFIX_.'supplier_order_state_lang` sosl ON
			(
				a.`id_state` = sosl.`id_supplier_order_state`
				AND sosl.`id_lang` = '.(int)$lang_id.'
			)
			LEFT JOIN `'._DB_PREFIX_.'employee` e ON (e.`id_employee` = a.`id_employee`)';

			$this->_where = 'AND a.`id_supplier_order` = '.(int)$id_supplier_order;
			$this->_orderBy = 'a.`date_add`';
			$this->_orderWay = 'DESC';

			// gets list and forces no limit clause in the request
			$this->getList($lang_id, 'date_add', 'DESC', 0, false, false);

			// renders list
			$helper = new HelperList();
			$helper->no_link = true;
			$helper->shopLinkType = '';
			$helper->identifier = $this->identifier;
			$helper->colorOnBackground = true;
			$helper->simple_header = true;
			$content = $helper->generateList($this->_list, $this->fieldsDisplay);

			echo Tools::jsonEncode(array('use_parent_structure' => false, 'data' => $content));
		}
		die;
	}

	/**
	 * Used to display details of an order
	 * @see AdminSupplierOrdersController::initContent()
	 */
	protected function viewSupplierOrder()
	{
		$this->displayInformation($this->l('This interface allows you to display detailed informations on your order.').'<br />');

		$this->table = 'supplier_order_detail';
		$this->identifier = 'id_supplier_order_detail';
	 	$this->className = 'SupplierOrderDetail';
	 	$this->colorOnBackground = false;
		$this->lang = false;
		$lang_id = (int)$this->context->language->id;

		// gets the id supplier to view
		$id_supplier_order = (int)Tools::getValue('id_supplier_order');

		// re-defines fieldsDisplay
		$this->fieldsDisplay = array(
			'p_reference' => array(
				'title' => $this->l('Reference'),
				'align' => 'center',
				'width' => 100,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'p_ean13' => array(
				'title' => $this->l('EAN13'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'p_name' => array(
				'title' => $this->l('Name'),
				'width' => 350,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'unit_price_te' => array(
				'title' => $this->l('Unit price (te)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'quantity' => array(
				'title' => $this->l('Quantity'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'price_te' => array(
				'title' => $this->l('Price (te)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'discount_rate' => array(
				'title' => $this->l('Discount rate'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'discount_value_te' => array(
				'title' => $this->l('Discount value (te)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'price_with_discount_te' => array(
				'title' => $this->l('Price with product discount (te)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'tax_rate' => array(
				'title' => $this->l('Tax rate'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'tax_value' => array(
				'title' => $this->l('Tax value'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'price_ti' => array(
				'title' => $this->l('Price (ti)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'tax_value_with_order_discount' => array(
				'title' => $this->l('Tax value with global order discount'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'price_with_order_discount_te' => array(
				'title' => $this->l('Price with global order discount (te)'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
			'exchange_rate' => array(
				'title' => $this->l('Exchange rate'),
				'align' => 'center',
				'width' => 75,
				'orderby' => false,
				'filter' => false,
				'search' => false,
			),
		);

		// just in case..
		unset($this->_select, $this->_join, $this->_where, $this->_orderBy, $this->_orderWay, $this->_group, $this->_filterHaving, $this->_filter);

		// gets all information on the products ordered
		$this->_select = '
		CONCAT(a.unit_price_te, \' \', c.sign) as unit_price_te,
		CONCAT(a.price_te, \' \', c.sign) as price_te,
		CONCAT(a.discount_value_te, \' \', c.sign) as discount_value_te,
		CONCAT(a.price_with_discount_te, \' \', c.sign) as price_with_discount_te,
		CONCAT(a.tax_value, \' \', c.sign) as tax_value,
		CONCAT(a.price_ti, \' \', c.sign) as price_ti,
		CONCAT(a.tax_value_with_order_discount, \' \', c.sign) as tax_value_with_order_discount,
		CONCAT(a.price_with_order_discount_te, \' \', c.sign) as price_with_order_discount_te,
		IFNULL(CONCAT(pl.name, \' : \', GROUP_CONCAT(agl.name, \' - \', al.name SEPARATOR \', \')), pl.name) as p_name,
		p.reference as p_reference,
		p.ean13 as p_ean13';
		$this->_join = '
		INNER JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = a.id_product AND pl.id_lang = '.$lang_id.')
		LEFT JOIN '._DB_PREFIX_.'product p ON (p.id_product = a.id_product)
		LEFT JOIN '._DB_PREFIX_.'product_attribute_combination pac ON (pac.id_product_attribute = a.id_product_attribute)
		LEFT JOIN '._DB_PREFIX_.'attribute atr ON (atr.id_attribute = pac.id_attribute)
		LEFT JOIN '._DB_PREFIX_.'attribute_lang al ON (al.id_attribute = atr.id_attribute AND al.id_lang = '.$lang_id.')
		LEFT JOIN '._DB_PREFIX_.'attribute_group_lang agl ON (agl.id_attribute_group = atr.id_attribute_group AND agl.id_lang = '.$lang_id.')
		LEFT JOIN '._DB_PREFIX_.'currency c ON (a.id_currency = c.id_currency)';
		$this->_where = 'AND a.`id_supplier_order` = '.(int)$id_supplier_order;
		$this->_group = 'GROUP BY a.id_product';

		// gets the list ordered by price desc, without limit
		$this->getList($lang_id, 'price_te', 'DESC', 0, false, false);

		// renders list
		$helper = new HelperList();
		$helper->simple_header = true;
		$helper->no_link = true;
		$helper->shopLinkType = '';
		$helper->identifier = $this->identifier;

		// generates content
		$content = $helper->generateList($this->_list, $this->fieldsDisplay);
		// displays content
		$this->context->smarty->assign('supplier_order_detail_content', $content);

		// gets global order information
		$supplier_order = new SupplierOrder((int)$id_supplier_order);
		if (Validate::isLoadedObject($supplier_order))
		{
			// gets the currency used in this order
			$currency = Currency::getCurrency($supplier_order->id_currency);
			$this->context->smarty->assign('supplier_order_currency_sign', $currency ? $currency['sign'] : '');

			// gets the employee in charge of the order
			$employee = new Employee($supplier_order->id_employee);
			$this->context->smarty->assign('supplier_order_employee', (Validate::isLoadedObject($employee) ? $employee->firstname.' '.$employee->lastname : ''));

			// display these global order informations
			$this->context->smarty->assign(
				array(
					'supplier_order_reference' => $supplier_order->reference,
					'supplier_order_last_update' => $supplier_order->date_upd,
					'supplier_order_expected' => $supplier_order->date_delivery_expected,
					'supplier_order_total_te' => $supplier_order->total_te,
					'supplier_order_discount_value_te' => $supplier_order->discount_value_te,
					'supplier_order_total_with_discount_te' => $supplier_order->total_with_discount_te,
					'supplier_order_total_tax' => $supplier_order->total_tax,
					'supplier_order_total_ti' => $supplier_order->total_ti,
				)
			);
		}
	}

	/**
	 * Callback used to display custom content for a given field
	 * @param int $id_supplier_order
	 * @param string $tr
	 * @return string $content
	 */
	public function printPDFIcons($id_supplier_order, $tr)
	{
		$supplier_order = new SupplierOrder((int)$id_supplier_order);
		if (!Validate::isLoadedObject($supplier_order))
			return;

		$supplier_order_state = new SupplierOrderState($supplier_order->id_supplier_order_state);
		if (!Validate::isLoadedObject($supplier_order_state))
			return;


		if ($supplier_order_state->editable == false && $supplier_order_state->delivery_note == true)
			$content .= '<a href="#"><img src="../img/admin/tab-invoice.gif" alt="invoice" /></a>';
		else
			$content .= '-';
		$content .= '</span>';

		return $content;
	}

	/**
	 * Assigns default actions in toolbar_btn smarty var, if they are not set.
	 * uses override to specifically add, modify or remove items
	 * @see AdminSupplier::initToolbar()
	 */
	public function initToolbar()
	{
		switch ($this->display)
		{
			case 'update_order_state':
				$this->toolbar_btn['save'] = array(
					'href' => '#',
					'desc' => $this->l('Save')
				);
			break;
			default:
				parent::initToolbar();
		}
	}
}