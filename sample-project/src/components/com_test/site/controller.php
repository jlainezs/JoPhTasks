<?php
/**
 * @package     JOdk.core
 * @subpackage  Main.Administrator
 * @author      Pep Lainez <jlainezs@econceptes.com>
 * @copyright   2016 EConceptes
 * @license     Licensed under GNU/GPL 3.0
 * @since       1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

/**
 * Main controller
 *
 * @author  Pep Lainez <jlainezs@econceptes.com>
 *
 * @since   1.0
 */
class JOdkController extends JControllerLegacy
{
	/**
	 * Typical view method for MVC based architecture
	 *
	 * This function is provide as a default implementation, in most cases
	 * you will need to override it in your own controllers.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  A JControllerLegacy object to support chaining.
	 *
	 * @since   12.2
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$input = JFactory::getApplication()->input;

		if ($input->getCmd('task', '') == 'jodk')
		{
			$input->set('view', 'ControlPanel');
		}

		$input->set('view', $input->getCmd('view', 'ControlPanel'));
		parent::display($cachable);
	}
}
