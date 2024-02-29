<?php

namespace lightframe;

class ViewBuilder
{
    private $template = 'html' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'template.php';
    private $beforeViewTemplate = 'html' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'beforeViewTemplate.php';
    private $afterViewTemplate = 'html' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'afterViewTemplate.php';
    private $view;

    private $title;
    private $description;

    private $cssFiles = [];
    private $jsFiles = [];
    private $externalCssFiles = [];
    private $externalJsFiles = [];

    public $components = [];
    public $layout = [];
    public $entities = [];

    private $renderedView;
    private $renderedBeforeView;
    private $renderedAfterView;

    public function __construct(string $view)
    {
        $this->view = 'html' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view;
    }

    public function render() : string
    {

        $this->cssFiles = array_unique($this->cssFiles);
        $this->jsFiles = array_unique($this->jsFiles);

        ob_start();
        require($this->view);
        $this->renderedView = ob_get_clean();
    
        ob_start();
        require($this->beforeViewTemplate);
        $this->renderedBeforeView = ob_get_clean();
    
        ob_start();
        require($this->afterViewTemplate);
        $this->renderedAfterView = ob_get_clean();

        ob_start();
        require($this->template);

        return ob_get_clean();
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function addCss(string $cssFile) : void
    {
        $this->cssFiles[] = 'css/' . $cssFile;
    }

    public function addJs(string $jsFile) : void
    {
        $this->jsFiles[] = 'js/' . $jsFile;
    }

    public function addLibraryCss(string $cssFile) : void
    {
        $this->cssFiles[] = 'libraries/' . $cssFile;
    }

    public function addLibraryJs(string $jsFile) : void
    {
        $this->jsFiles[] = 'libraries/' . $jsFile;
    }

    public function addExternalCss(string $externalCssFile) : void
    {
        $this->externalCssFiles[] = $externalCssFile;
    }

    public function addExternalJs(string $externalJsFile) : void
    {
        $this->externalJsFiles[] = $externalJsFile;
    }
}