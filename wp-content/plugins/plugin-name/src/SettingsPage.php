<?php

namespace PluginName\Plugin;

class SettingsPage
{
    protected $pluginData;

    public function __construct(array $pluginData)
    {
        $this->pluginData = $pluginData;
    }

    public function init(): void
    {
        $this->addOptionsSubmenu();
    }

    public function renderPage(): void
    {
        echo 'Settings Page';
    }

    public function addOptionsSubmenu(): void
    {
        $title = strip_tags($this->pluginData['Title']);
        add_submenu_page(
            'options-general.php',
            "$title Settings",
            $title,
            'administrator',
            $this->pluginData['Name'] . '-options',
            [$this, 'renderPage']
        );
    }
}
