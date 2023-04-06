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

    private function getIncludedFile() {
        return [
            "navbar" => $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/navbar.php",
            "main" => $_SERVER['DOCUMENT_ROOT'] . "/Views/" . $this->template . ".php",
            "footer" => $_SERVER['DOCUMENT_ROOT'] . "/Views/layout/footer.php",
        ];
    }
}

?>

