<?php
class emp_mdl extends DB{

    public function __construct(){
      parent::__construct();
    }

    public function createEmp($data,$addresses){
        //responseHandler('success',$data);
      $id = $this->insert('employee',$data);
      foreach($addresses as $address){
        $address['eid'] = $id;
        $this->insert('employeeaddress',$address);
      }
      return $id;
    }
   
    public function singleEmp($id){
       $employee = $this->getRows('employee',['where'=>['eid'=>$id],'return_type'=>'single']);
       if($employee){
        $employee['addressDetails'] = $this->getRows('employeeaddress',['where'=>['eid'=>$id]]);
        return $employee;
       }else{
         return false;
       }
      
    }

    public function allEmp(){
        $result = $this->getRows('employee');
        return $result?$result:[];
    }

    public function updateEmp($id,$data,$addresses){
      $this->delete('employeeaddress',['eid'=>$id]);
      $result = $this->update('employee',$data,['eid'=>$id]);
      foreach($addresses as $address){
        $address['eid'] = $id;
        $this->insert('employeeaddress',$address);
      }
      return $result;
    }

    public function deleteEmp($id){
        $result = $this->delete('employee',['eid'=>$id]);
        $this->delete('employeeaddress',['eid'=>$id]);
        return $result;
    }

  public function createEmp2($data,$addresses){
    $id = $this->insert('employee',$data);
    foreach($addresses as $address){
      $address['eid'] = $id;
      $this->insert('empdocuments',$address);
    }
    return $id;
  }

  public function singleEmp2($id){
    $employee = $this->getRows('employee',['where'=>['eid'=>$id],'return_type'=>'single']);
    if($employee){
      $employee['documentDetails'] = $this->getAllDocs($id);
      return $employee;
    }else{
      return false;
    }
   
   }

   public function getAllDocs($id){
    $docs = $this->getRows('empdocuments',['where'=>['eid'=>$id]]);
    return $docs?$docs:[];
   }

  public function updateEmp2($id,$data,$addresses){
    $this->delete('empdocuments',['eid'=>$id]);
    $result = $this->update('employee',$data,['eid'=>$id]);
    foreach($addresses as $address){
      $address['eid'] = $id;
      $this->insert('empdocuments',$address);
    }
    return $result;
  }

  public function deleteEmp2($id){
    $result = $this->delete('employee',['eid'=>$id]);
    $this->delete('empdocuments',['eid'=>$id]);
    return $result;
  }

  
}


?>