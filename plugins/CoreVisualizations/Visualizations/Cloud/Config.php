<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik_Plugins
 * @package CoreVisualizations
 */

namespace Piwik\Plugins\CoreVisualizations\Visualizations\Cloud;

use Piwik\ViewDataTable\Visualization\Config as VisualizationConfig;

/**
 * DataTable Visualization that derives from HtmlTable and sets show_extra_columns to true.
 */
class Config extends VisualizationConfig
{

    /**
     * Whether to display the logo assocatied with a DataTable row (stored as 'logo' row metadata)
     * instead of the label in Tag Clouds.
     *
     * Default value: false
     */
    public $display_logo_instead_of_label = false;

    public function __construct()
    {
        parent::__construct();

        $this->addPropertiesThatCanBeOverwrittenByQueryParams(array('display_logo_instead_of_label'));
    }

}