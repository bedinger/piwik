/*!
 * Piwik - Web Analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

$(document).ready(function () {

    $submit = $('.pluginsSettingsSubmit');

    if (!$submit) {
        return;
    }

    $submit.click(updatePluginSettings);

    function updatePluginSettings()
    {
        var ajaxHandler = new ajaxHelper();
        ajaxHandler.addParams({
            module: 'CoreAdminHome',
            action: 'setPluginSettings'
        }, 'GET');
        ajaxHandler.addParams({settings: getSettings()}, 'POST');
        ajaxHandler.redirectOnSuccess();
        ajaxHandler.setLoadingElement(getLoadingElement());
        ajaxHandler.setErrorElement(getErrorElement());
        ajaxHandler.send(true);
    }

    function getSettings()
    {
        var $pluginSections = $( "#pluginSettings[data-pluginname]" );

        var values = {};

        $pluginSections.each(function (index, pluginSection) {
            $pluginSection = $(pluginSection);

            var pluginName = $pluginSection.attr('data-pluginname');
            var serialized = $('input, textarea, select', $pluginSection ).serializeArray();

            values[pluginName] = serialized;
        });

        return values;
    }

    function getErrorElement()
    {
        return $('#ajaxErrorPluginSettings');
    }

    function getLoadingElement()
    {
        return $('#ajaxLoadingPluginSettings');
    }

});