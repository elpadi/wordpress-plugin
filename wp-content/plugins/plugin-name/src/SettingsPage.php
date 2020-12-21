<?php

namespace PluginName\Plugin;

use function Stringy\create as s;

class SettingsPage
{
    protected $pluginData;
    protected $pluginName;
    protected $pluginSlug;

    public function __construct(array $pluginData)
    {
        $this->pluginData = $pluginData;
        $this->pluginName = strip_tags($this->pluginData['Title']);
        $this->pluginSlug = s($this->pluginData['Name'])->slugify();
    }

    public function init(): void
    {
        $this->addOptionsSubmenu();
        $this->addSettings();
        $this->addFields();
    }

    public function renderPage(): void
    {
        echo 'Settings HTML HERE';
        do_settings_sections($this->pluginSlug . '-options');
    }

    public function renderSettings(array $settingsArgs): void
    {
        // echo section intro text here
        echo '<p>id: ' . $settingsArgs['id'] . '</p>';             // id: eg_setting_section
        echo '<p>title: ' . $settingsArgs['title'] . '</p>';       // title: Example settings section in reading
    }

    public function textField(array $fieldArgs): void
    {
        var_dump($fieldArgs);
        printf('<input name="%s" id="%s">', "$this->pluginSlug-options", "$this->pluginSlug-options");
    }

    protected function addFields(): void
    {
        add_settings_field(
            "$this->pluginSlug-text-field",
            "Text Field",
            [$this, 'textField'],
            "$this->pluginSlug-options",
            "$this->pluginSlug-settings-1"
        );
    }

    protected function addSettings(): void
    {
        add_settings_section(
            "$this->pluginSlug-settings-1",
            'Settings One',
            [$this, 'renderSettings'],
            "$this->pluginSlug-options"
        );
    }

    protected function addOptionsSubmenu(): void
    {
        add_submenu_page(
            'options-general.php',
            "$this->pluginName Settings",
            $this->pluginName,
            'administrator',
            "$this->pluginSlug-options",
            [$this, 'renderPage']
        );
    }
}
