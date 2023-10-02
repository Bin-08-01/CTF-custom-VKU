<?php 
if (isset($_GET['debug-system'])) {
    die(highlight_file('system.php'));
}
class System{
    private $cmdName, $cmdId;
    function __construct(){
        $this->cmdName = "whoami";
        $this->cmdId = "id";
    }

    function getName(){
        return system($this->cmdName);
    }

    function getId(){
        return system($this->cmdId);
    }
}
?>

<!-- /?debug-system to view source -->