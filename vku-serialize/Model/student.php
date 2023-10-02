<?php
if (isset($_GET['debug-student'])) {
    die(highlight_file('student.php'));
}
class Student{
    private $name, $id, $gender;
    function __construct($name, $id, $gender){
        $this->name = $name;
        $this->id = $id;
        $this->gender = $gender;
    }

    function getName(){
        return $this->name;
    }
    
    function getId(){
        return $this->id;
    }

    function getGender(){
        return $this->gender;
    }

    function setName($name){
        $this->name = $name;
    }

    function setId($id){
        $this->id = $id;
    }

    function setGender($gender){
        $this->gender = $gender;
    }

    function __toString(){
        return "Thông tin sinh viên: " . getName() . " - " . getId() . " - " . getGender();
    }
}
?>
<!-- /?debug-student to view source -->