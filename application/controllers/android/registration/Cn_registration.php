<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cn_registration extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Md_Common');
    }

    public function purohit_registration(){
        $first_name=!empty($this->input->post('first_name'))? ucfirst($this->input->post('first_name')):'';
        $middle_name=!empty($this->input->post('middle_name'))?ucfirst($this->input->post('middle_name')):'';
        $last_name=!empty($this->input->post('last_name'))?ucfirst($this->input->post('last_name')):'';
        $mobileno=!empty($this->input->post('mobileno'))?$this->input->post('mobileno'):'';
        $alernatemob=!empty($this->input->post('alernatemob'))?$this->input->post('alernatemob'):'';
        $email_id=!empty($this->input->post('email_id'))?$this->input->post('email_id'):'';
        $dob=!empty($this->input->post('dob')) ? date('Y-m-d',strtotime($this->input->post('dob'))):null;
        
        $address=!empty($this->input->post('address'))?$this->input->post('address'):'';
        $state_id=!empty($this->input->post('state_id'))?$this->input->post('state_id'):'';
        $city_id=!empty($this->input->post('city_id'))?$this->input->post('city_id'):'';
        $city_name=!empty($this->input->post('city_name'))?$this->input->post('city_name'):'';
        $gurukulname=!empty($this->input->post('gurukulname'))?$this->input->post('gurukulname'):'';
        $area=!empty($this->input->post('area'))?$this->input->post('area'):'';
        $expyear=!empty($this->input->post('expyear'))?$this->input->post('expyear'):'';
        $token = !empty($this->input->post('token')) ? trim($this->input->post('token'))  : '';
        $certificate_name = !empty($this->input->post('certificate_name')) ? trim($this->input->post('certificate_name'))  : '';
        $profile_image = !empty($this->input->post('profile_image')) ? trim($this->input->post('profile_image'))  : '';
        $bank_name = !empty($this->input->post('bank_name')) ? $this->input->post('bank_name') : '';
        $ifsc_code = !empty($this->input->post('ifsc_code')) ? $this->input->post('ifsc_code') : '';
        $branch_name = !empty($this->input->post('branch_name')) ? $this->input->post('branch_name') : '';
        $holder_name = !empty($this->input->post('holder_name')) ? $this->input->post('holder_name') : '';
        $account_number = !empty($this->input->post('account_number')) ? $this->input->post('account_number') : '';
        // $languages=[{"pk_id":"1"}]
        $languages = !empty($this->input->post('languages')) ?  $this->input->post('languages') : "";
        $language_id = json_decode($languages);

        //Edit Data Post
        $purohit_id=!empty($this->input->post('purohit_id'))?$this->input->post('purohit_id'):'';
        $old_profile_name = !empty($this->input->post('old_profile_name')) ?  $this->input->post('old_profile_name') : "";
        $old_certificate_name = !empty($this->input->post('old_certificate_name')) ?  $this->input->post('old_certificate_name') : "";
 
        $reg_purohit_full_name=$first_name.' '.$middle_name.' '.$last_name;
      

        $photoDoc = "";
        $photoDoc2 = "";
        // print_r($profile_image);
        // print_r($certificate_name);
        // die();
        
        // if (!empty($_FILES['certificate_name']['name'])) {
        //     $rename_name = uniqid(); //get file extension:
        //     $arr_file_info = pathinfo($_FILES['certificate_name']['name']);
        //     $file_extension = $arr_file_info['extension'];
        //     $newname = $rename_name . '.' . $file_extension;
        //   // print_r($newname);die();
        //     $old_name = $_FILES['certificate_name']['name'];
        //    $path = "upload/android/registartion/purohit_certificate/";
        //     // print_r($path);die();
        //     if (!is_dir($path)) {
        //         mkdir($path, 0777, true);
        //     }                
        //     $upload_type = "jpg|png|jpeg|pdf|doc|zip";

        //     $photoDoc = $this->Md_database->uploadFile($path, $upload_type, "certificate_name", "", $newname);
            
        //     if (!empty($this->input->post('old_profile_name'))) {
        //         unlink(FCPATH . 'upload/android/registartion/purohit_certificate/' . $this->input->post('old_profile_name'));
        //     }
        // }
        // // $photoDoc = !empty($photoDoc) ? $photoDoc : $this->input->post('oldimg1');

        // if (!empty($_FILES['profile_image']['name'])) {
        //     $rename_name = uniqid(); //get file extension:
        //     $arr_file_info = pathinfo($_FILES['profile_image']['name']);
        //     $file_extension = $arr_file_info['extension'];
        //     $newname = $rename_name . '.' . $file_extension;
        //   // print_r($newname);die();
        //     $old_name = $_FILES['profile_image']['name'];
        //     // print_r($old_name);die();
        //     $path = "upload/android/registartion/purohit_profile/";

        //     if (!is_dir($path)) {
        //         mkdir($path, 0777, true);
        //     }
        //     $upload_type = "jpg|png|jpeg";

        //     $photoDoc2 = $this->Md_database->uploadFile($path, $upload_type, "profile_image", "", $newname);

        //       if (!empty($this->input->post('old_profile_name'))) {
        //         unlink(FCPATH . 'upload/android/registartion/purohit_profile/' . $this->input->post('old_profile_name'));
        //     }       
        // // $photoDoc2 = !empty($photoDoc2) ? $photoDoc2 : $this->input->post('oldimg2');
        // }
        if (!empty($profile_image)) {
            $photoDoc2 = uniqid();
            $path = "upload/android/registartion/purohit_profile/".$photoDoc2;
            file_put_contents($path,base64_decode($profile_image));

        }
         if (!empty($certificate_name)) {
            $photoDoc = uniqid();
            $path = "upload/android/registartion/purohit_certificate/".$photoDoc;
            file_put_contents($path,base64_decode($certificate_name));
        }
       
         
                if (empty($purohit_id)){
                    if (empty($first_name) || empty($middle_name) ||empty($last_name) || empty($state_id) || empty($city_id) ||empty($email_id) ||empty($mobileno) ||empty($dob) || empty($address) ||empty($gurukulname) || empty($expyear) || empty($area) || empty($token) ) {
                        $resultarray = array('error_code' => '3', 'message' => 'All fields required');
                        echo json_encode($resultarray); 
                        exit();                      
                    }else{  
                        $table = "registered_purohit";
                        $select = array('email_id,mobile_no');
                        // if (!empty($purohit_id)) {
                        //     $this->db->where('pk_id!=',$purohit_id);
                        // }
                        $this->db->where('status<>','3');
                        $this->db->where('email_id',$email_id);
                        $this->db->or_where('mobile_no',$mobileno);
                        // $condition = array('status<>'=>'3');
                        $check_email_mob = $this->Md_database->getData($table, $select,'','', '');
                                                           
                                //Registration
                                $token = substr((uniqid(rand(), true)), 0, 6);
                                $password = 'SP' . $token;
                                $insert_data = array(
                                    'first_name' => $first_name,
                                    'middle_name'=>$middle_name,
                                    'last_name' => $last_name,
                                    'fk_state_id' => $state_id,
                                    'fk_city_id' => $city_id,
                                    'city_name' => $city_name,
                                    'email_id' => $email_id,
                                    'password' => base64_encode($password),
                                    'mobile_no' => $mobileno,
                                    'alternate_mobile_no' => $alernatemob,
                                    'user_dob' => date('Y-m-d', strtotime($dob)),
                                    'address' => $address,
                                    'pathshala_gurukul_name' => $gurukulname,
                                    'exp_years' => $expyear,
                                    'location' => $area,
                                    'bank_name' => $bank_name,
                                    'ifsc_code' => $ifsc_code,
                                    'branch_name' => $branch_name,
                                    'account_holder_name' => $holder_name,
                                    'account_number' => $account_number,
                                    'token' => $token,
                                    'upload_certificate_image' => $photoDoc,
                                    'upload_profile_image' => $photoDoc2,
                                    'status'=>1,
                                    'created_date'=>date('Y-m-d H:i:s'),
                                    // 'created_by' => $uid,
                                    'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                                );
                                        
                                $ret = $this->Md_database->insertData('registered_purohit', $insert_data);
                                $purohit_id = $this->db->insert_id();

                                if (!empty($language_id)) {  
                                    for ($i = 0; $i < count($language_id); $i++) {
                                // print_r($language_id[$i]->pk_id)  ;
                                // die();        
                                        $table = "registered__purohit_language";
                                        $insert_data2 = array(
                                            'fk_purohit_id' => $purohit_id,
                                            'fk_language_id' => $language_id[$i]->pk_id,
                                            'status' => '1',
                                            'created_by' => $purohit_id,
                                            'created_date' => date('Y-m-d H:i:s'),
                                            'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                                        );
                                        $this->Md_database->insertData($table, $insert_data2);
                                    }
                                }              
                                $recipeinets = $email_id;
                                $from = array(
                                    "email" => SITE_MAIL,
                                    "name" => SITE_TITLE
                                );
                                $reserved_words = array(
                                    "||USER_NAME||" => $reg_purohit_full_name,
                                    "||SITE_TITLE||" => SITE_TITLE,
                                    "||EMAIL_ID||" => strtolower($email_id),
                                    "||PASSWORD||" => $password,
                                    "||CONTACT_US||" => 'shripurohit7@gmail.com',
                                    "||YEAR||" => date('Y'),
                                );
                                $email_data = $this->Md_database->getEmailInfo('user_reg_mail', $reserved_words);
                                $subject = SITE_TITLE . '-' . $email_data['subject'];
                                // print_r($email_data);die();

                                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);
                                /* [end::send otp varification code mail] */
                                if (!empty($purohit_id)) {
                                    $resultarray = array('error_code' => '1', 'message' => 'The password has been sent to your registered Email ID','purohit_id'=>$purohit_id);
                                    echo json_encode($resultarray); 
                                    exit();

                                }
                    }
                }else{
                    $table = "registered_purohit";
                        $select = array('email_id,mobile_no,pk_id');
                        $this->db->where('status<>','3');
                        $this->db->where('email_id',$email_id);
                        $this->db->or_where('mobile_no',$mobileno);
                        $check_email_mob = $this->Md_database->getData($table, $select,'','', '');

                        if (!empty($check_email_mob[0]['email_id']) && $check_email_mob[0]['email_id']==$email_id  && !empty($purohit_id) && $check_email_mob[0]['pk_id']!=$purohit_id ) {
           
                            $resultarray = array('error_code' => '2', 'message' => 'This EmailID number is already exists.');
                            echo json_encode($resultarray); 
                            exit();
                        }else{  
                            if (!empty($check_email_mob[0]['mobile_no']) && $check_email_mob[0]['mobile_no']==$mobileno  && !empty($purohit_id) && $check_email_mob[0]['pk_id']!=$purohit_id ) {

                                $resultarray = array('error_code' => '4', 'message' => 'This mobile number is already exists.');
                                echo json_encode($resultarray); 
                                exit();
                            }else{ 

                                //Update profile                   
                                $update_data = array(
                                    'status'=> 1,
                                    'updated_by' => $purohit_id, 
                                    'updated_date' => date('Y-m-d H:i:s'),
                                    'updated_ip_address' => $_SERVER['REMOTE_ADDR']
                                );
                                $condition = array(
                                    'pk_id'=>$purohit_id
                                );
                                if (!empty($first_name)) {
                                    $update_data['first_name']=$first_name;
                                }
                                if (!empty($middle_name)) {
                                    $update_data[ 'middle_name']=$middle_name;
                                }if (!empty($last_name)) {
                                    $update_data['last_name']= $last_name;  
                                }if (!empty($state_id)) {
                                    $update_data['fk_state_id']=$state_id;
                                }if (!empty($city_id)) {
                                    $update_data['fk_city_id']= $city_id;
                                }if (!empty($city_name)) {
                                     $update_data['city_name']= $city_name;
                                }if (!empty($email_id)) {
                                    $update_data['email_id']=$email_id; 
                                }if (!empty($mobileno)) {
                                    $update_data['mobile_no']=$mobileno;
                                }if (!empty($alernatemob)) {
                                    $update_data['alternate_mobile_no']=$alernatemob;
                                }if (!empty($gurukulname)) {
                                     $update_data['pathshala_gurukul_name']=$gurukulname;
                                }if (!empty($expyear)) {
                                    $update_data['exp_years']=$expyear;
                                }if (!empty($bank_name)) {
                                    $update_data['bank_name']=$bank_name;
                                }if (!empty($ifsc_code)) {
                                    $update_data['ifsc_code']=$ifsc_code;
                                }if (!empty($branch_name)) {
                                    $update_data['branch_name']=$branch_name;
                                }if (!empty($holder_name)) {
                                    $update_data['account_holder_name']=$holder_name;
                                }if (!empty($account_number)) {
                                    $update_data['account_number']=$account_number;
                                }if (!empty($token)) {
                                     $update_data['token']=$token;
                                }if (!empty($area)) {
                                    $update_data['location']=$area;
                                }if (!empty($photoDoc)) {
                                    $update_data['upload_certificate_image']=$photoDoc;
                                }if (!empty($photoDoc2)) {
                                    $update_data['upload_profile_image']=$photoDoc2;
                                }
                                if (!empty($dob)) {
                                    $update_data['user_dob'] = date('Y-m-d', strtotime($dob));
                                }
                                
                               // echo "<pre>"; print_r($update_data); die();
                                
                                // $update_data['password']=base64_encode($password);
                                
                                $resultarray = $this->Md_database->updateData('registered_purohit', $update_data, $condition);
                                
                            
                                if (!empty($language_id)) {
                                    $table = "registered__purohit_language";                          
                                    $condition = array('fk_purohit_id' => $purohit_id); 
                                    $resultarray = $this->Md_database->deleteData($table, $condition);
                                
                                    for ($i = 0; $i < count($language_id); $i++) {
                                        $table = "registered__purohit_language";
                                        $insert_data2 = array(
                                            'fk_purohit_id' => $purohit_id,
                                            'fk_language_id' => $language_id[$i]->pk_id,
                                            'status' => '1',
                                            'created_by' => $purohit_id,
                                            'created_date' => date('Y-m-d H:i:s'),
                                            'created_ip_address' => $_SERVER['REMOTE_ADDR'],
                                        );
                                        $this->Md_database->insertData($table, $insert_data2);
                                    }
                                }
                                $resultarray = array('error_code' => '1', 'message' => 'Personal details updated successfully','purohit_id'=>$purohit_id);
                                echo json_encode($resultarray); 
                                exit();
                            }
                        }
                }
            // }
        // }          
    }

    public function language_list(){
        $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
            if (!empty($uid)) {
                $table = "purohit_registered_purohit";
                $orderby = 'pk_id asc';
                $condition = array('status' => '2', 'pk_id' => $uid);
                $col = array('pk_id');
                $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
                if (!empty($checkUser)){
                    $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                    echo json_encode($resultarray);            
                    exit();
                }
            }
                $table = "master_language";
                $select = "language,pk_id";
                $condition = array(
                    'status ' => '1',
                );
                $this->db->order_by('language', 'ASC');
                $all_language = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
              
                $resultarray = array('error_code' => '1', 'message' => 'Language List','language_list'=>!empty($all_language)?$all_language:[]);
                echo json_encode($resultarray);
                exit(); 
                
            // }else {
            //     $resultarray = array('error_code' => '2', 'message' => 'Uid is empty');
            //         echo json_encode($resultarray);
            //     exit();                       
            // }            
    } 
    public function state_list(){
        $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        if (!empty($uid)) {
            $table = "purohit_registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'pk_id' => $uid);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)){
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);            
                exit();
            }
        }
        $table = "master_state";
        $select = "state,pk_id";
        $condition = array(
            'status ' => '1',
        );
        $this->db->order_by('state', 'ASC');
        $all_state = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
      
        $resultarray = array('error_code' => '1', 'message' => 'State List','state_list'=>!empty($all_state)?$all_state:[]);
        echo json_encode($resultarray);
        exit();                            
    } 

    public function city_list(){
        $uid = !empty($this->input->post('uid')) ? $this->input->post('uid') : '';
        $state = !empty($this->input->post('state_id')) ? $this->input->post('state_id') : '';
        if (!empty($uid)) {
            $table = "purohit_registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'pk_id' => $uid);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)){
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);            
                exit();
            }
        }
        if (!empty($state)){
            $table = "master_city";
            $select = "city,pk_id";
            $condition = array(
                'status ' => '1',
                'state'=>$state
            );

            $this->db->order_by('city', 'ASC');
            $city = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
        }else{
            $resultarray = array('error_code' => '2', 'message' => 'state_id is empty');
            echo json_encode($resultarray);
            exit(); 
            // $table = "master_city";
            // $select = "city,pk_id";
            // $condition = array(
            //     'status ' => '1',                  
            // );
            // $this->db->order_by('city', 'ASC');
            // $Allcity = $this->Md_database->getData($table, $select, $condition, 'pk_id ASC', '');
        }
        // $table = "purohit_registered_purohit";
        // $select = "C.city_name,user.city as cityid";
        // $condition = array(
        //     'registered_purohit.status' => '1', 
        //     'registered_purohit.pk_id'=>$uid                 
        // );
        // $this->db->join('master_city as C', 'C.pk_id = registered_purohit.fk_city_id');
        // $this->db->order_by('registered_purohit.pk_id', 'ASC');
        // $registerCityState = $this->Md_database->getData($table, $select, $condition, 'user.pk_id ASC', '');
        // $empty=array();

        $resultarray = array('error_code' => '1', 'message' => 'City List','statewise_city'=>!empty($city)?$city:[]);
        echo json_encode($resultarray);
        exit(); 
             

        // }else {
        //     $resultarray = array('error_code' => '2', 'message' => 'Uid is empty');
        //         echo json_encode($resultarray);
        //     exit();                       
        // }            
    }

    public function login(){   
        $username = !empty($this->input->post('username')) ? $this->input->post('username') : '';
        $password = !empty($this->input->post('password')) ? trim($this->input->post('password'))  : '';
        $token = !empty($this->input->post('token')) ? trim($this->input->post('token'))  : '';

        if (!empty($username) || !empty($password)) {
            $table = "purohit_registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'email_id' => $username);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)) {
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);
                exit();
            }
        }
        if (empty($username) || empty($password) || empty($token)) {
            $resultarray = array('error_code' => '3', 'message' => 'username or password or token is empty.');
            echo json_encode($resultarray);
            exit();
        }else{
            //update token
            $insert_data = array(
                'token' => $token, 
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_ip_address' => $_SERVER['REMOTE_ADDR']           
             );
            $condition = array('email_id'=> $username);
            $this->db->where('status','1');
            $this->Md_database->updateData('purohit_registered_purohit', $insert_data, $condition);

            $table = "purohit_registered_purohit";
            $orderby = 'purohit_registered_purohit.pk_id asc';
            $condition = array('purohit_registered_purohit.status' => '1', 'email_id' => $username, 'password' => base64_encode($password)); 
            $col = array('registered_purohit.pk_id,email_id');
            $checkCreaditial = $this->Md_database->getData($table, $col, $condition, $orderby, '');

            if (!empty($checkCreaditial)) {
                $resultarray = array('error_code' => '1','message' => 'Login successfully!','purohit_id'=>!empty($checkCreaditial[0]['pk_id'])?$checkCreaditial[0]['pk_id']:'');
                echo json_encode($resultarray);
                exit();
            }else{
                $resultarray = array('error_code' => '2','message' => 'Enter valid credentials!');
                echo json_encode($resultarray);
                exit();                    
                
            }
        }            
    }

    public function reset_password_setting(){
        $username = !empty($this->input->post('username')) ? $this->input->post('username') : '';
        $password = !empty($this->input->post('password')) ? trim($this->input->post('password'))  : '';

        if (!empty($username) || !empty($password)) {
            $table = "purohit_registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'email_id' => $username);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)) {
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);
                exit();
            }
        }
        if (!empty($username) && !empty($password)) {
            $table = "purohit_registered_purohit";
            $orderby = 'purohit_registered_purohit.pk_id asc';
            $condition = array('purohit_registered_purohit.status' => '1', 'email_id' => $username); 
            $col = array('registered_purohit.pk_id,email_id,password');
            $checkData = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (empty($checkData)) {
                $resultarray = array('error_code' => '2','message' => 'Please enter Registered Username');
                echo json_encode($resultarray);
            }elseif($password == $checkData[0]['password']){
                $resultarray = array('error_code' => '3','message' => 'Password is same as old password');
                echo json_encode($resultarray);
                exit();
            }else {
                $insert_data = array(
                      'password' => base64_encode($password), 
                    'updated_date' => date('Y-m-d H:i:s'),
                    'updated_ip_address' => $_SERVER['REMOTE_ADDR']           
                );
                $condition = array('email_id'=> $username);
                $this->db->where('status','1');
                $this->Md_database->updateData('purohit_registered_purohit',$insert_data, $condition);

                $resultarray = array('error_code' => '1','message' => 'Reset password successfully!');
                echo json_encode($resultarray);
                exit();
            }
        }else{
            $resultarray = array('error_code' => '4', 'message' => 'username or password is empty.');
            echo json_encode($resultarray);
            exit();
                
        } 
    }
    public function forgot_password(){
          $username = !empty($this->input->post('username'))?$this->input->post('username'):'';
            if (!empty($username)) {
            $table = "purohit_registered_purohit";
            $orderby = 'pk_id asc';
            $condition = array('status' => '2', 'email_id' => $username);
            $col = array('pk_id');
            $checkUser = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (!empty($checkUser)) {
                $resultarray = array('error_code' => '10', 'message' => 'User is inactive. Please contact to ' . SITE_TITLE);
                echo json_encode($resultarray);
                exit();
            }
        }
        if (!empty($username)) {
            $table = "purohit_registered_purohit";
            $orderby = 'purohit_registered_purohit.pk_id asc';
            $condition = array('purohit_registered_purohit.status' => '1', 'email_id' => $username); 
            $col = array('registered_purohit.pk_id,email_id,password,first_name,last_name');
            $checkData = $this->Md_database->getData($table, $col, $condition, $orderby, '');
            if (empty($checkData)) {
                $resultarray = array('error_code' => '2','message' => 'Please enter Registered Username');
                echo json_encode($resultarray);
            }else{
                //Update profile     
                $token = substr((uniqid(rand(), true)), 0, 6);
                $password = 'SP' . $token;              
                $update_data = array(
                    'status'=> 1,
                    'password'=> base64_encode($password),  
                    'updated_date' => date('Y-m-d H:i:s'),
                    'updated_ip_address' => $_SERVER['REMOTE_ADDR']
                );
                $condition = array(
                    'email_id'=>$username,
                );
                $resultarray = $this->Md_database->updateData('purohit_registered_purohit', $update_data, $condition);
                
                 //Send mail
                $recipeinets = $username;
                $from = array(
                    "email" => SITE_MAIL,
                    "name" => SITE_TITLE
                );
                //echo "<pre>"; print_r($fro); die();
                $reserved_words = array(
                    "||USER_NAME||" => $checkData[0]['first_name']." ".$checkData[0]['last_name'],
                    "||SITE_TITLE||" => SITE_TITLE,
                    "||EMAIL_ID||" => strtolower($username),
                    "||PASSWORD||" => $password,
                    "||CONTACT_US||" => 'shripurohit7@gmail.com',
                    "||YEAR||" => date('Y'),
                );
                $email_data = $this->Md_database->getEmailInfo('forgot_password', $reserved_words);
                echo "<pre>"; print_r($email_data); die();
                $subject = SITE_TITLE . '-' . $email_data['subject'];
                // print_r($email_data);die();

                $ml = $this->Md_database->sendEmail($recipeinets, $from, $subject, $email_data['content']);

                $resultarray = array('error_code' => '1','message' => 'Please check new password on email.');
                echo json_encode($resultarray);
                exit();
            }
        }else{
            $resultarray = array('error_code' => '4', 'message' => 'username o is empty.');
            echo json_encode($resultarray);
            exit();
        }
    }
    
    
    public function check_email()
    {
        $email = !empty($this->input->post('email_id'))?$this->input->post('email_id'):"";
        
        if(empty($email))
        {
            $resultarray = array('error_code' => '4', 'message' => 'Email id is empty.');
            echo json_encode($resultarray); die();
        }
        else
        {
            $result = $this->Md_Common->check_email($email);
            
            if($result > 0)
            {
                $resultarray = array('error_code' => '4', 'message' => 'The Email id you have entered already exists with another account. Please try with another email id.');
                echo json_encode($resultarray); die();
            }
            else
            {
                $resultarray = array('error_code' => '1');
                echo json_encode($resultarray); die();
            }
        }
        
    }
    
    public function check_mobile()
    {
        $mobile = !empty($this->input->post('mobileno'))?$this->input->post('mobileno'):"";
        
        if(empty($mobile))
        {
            $resultarray = array('error_code' => '4', 'message' => 'Mobile No is empty.');
            echo json_encode($resultarray); die();
        }
        else
        {
            $result = $this->Md_Common->check_mobile($mobile);
            
            if($result > 0)
            {
                $resultarray = array('error_code' => '4', 'message' => 'The mobile number you have entered already exists with another account. Please try with another number.');
                echo json_encode($resultarray); die();
            }
            else
            {
                $resultarray = array('error_code' => '1');
                echo json_encode($resultarray); die();
            }
        }
        
    }

}





