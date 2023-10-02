<?php
if (isset($_GET['debug-student'])) {
    die(highlight_file('student.php'));
}
class Student{
    public $name, $id, $gender;

    public function __construct($name, $id, $gender){
        $this->name = $name;
        $this->id = $id;
        $this->gender = $gender;
    }

    public function getName(){
        return $this->name;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getGender(){
        return $this->gender;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function __toString(){
        return "Thông tin sinh viên: " . $this->getName() . " - " . $this->getId() . " - " . $this->getGender();
    }
}
?>
<!-- /?debug-student to view source -->