<?php

class View {

    protected $template = null;

    public function __construct($template) {
        $this->template = $template;
    }

    public function print($data) {
        return htmlspecialchars((string) $data, ENT_QUOTES, 'UTF-8');
    }

    public function render(Array $data) {
        extract($data);     
        ob_start();
        $includedFiles = $this->getIncludedFile();
        foreach($includedFiles as $key => $includedFile) {
            include($includedFile);
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function testRender(Array $data) {
        ob_start();
        extract($data);
        require($_SERVER['DOCUMENT_ROOT'] . "/Views/" . $this->template . ".php");

        var_dump(ob_get_clean()); die;
        
        return ob_get_clean();
    }


    public function renderPartial(Array $data) {
        extract($data);     
        ob_start();
        $includedFiles = $this->getIncludedFilePartial();
        foreach($includedFiles as $key => $includedFile) {
            include($includedFile);
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    private function getIncludedFilePartial() {
        return [
            "main" => $_SERVER['DOCUMENT_ROOT'] . "/Views/" . $this->template . ".php"
        ];  
    }

    private function getIncludedFile() {
        $navbar = '';
        if ($this->template == 'Mark') {
            $navbar = $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/internalNavbar.php";
        } else {
            $navbar =  $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/navbar.php";
        }

        return [
            "navbar" => $navbar,
            "main" => $_SERVER['DOCUMENT_ROOT'] . "/Views/" . $this->template . ".php",
            "footer" => $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/footer.php",
        ];
    }
}

?>

