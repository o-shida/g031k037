<?php
    class User extends Model{
        public $name = 'User';

        public $validate = array(
                    'name' => array(
                        'between' => array(
                           'rule' => array('between',0,10),
                           'required' => true,
                           'alloEmpty' => false,
                           'message' => '10文字以内で必ず入力して下さい'
                        ),
                        "unique" => array(
                           'rule' => 'isUnique',
                           "message" => "このユーザは既に登録されています"
                        ),
                        'custom' => array(
                          'rule' => array('custom', '/^[a-zA-Z]+$/'),
                           'message' => '英字のみで入力してください。'
                        ),
                         "notempty" => array(
                           'rule' => 'notEmpty',
                           "message" => "入力してください"
                          )
                         ),
                    'password' => array(
                      'rule' => 'notempty',
                      'required' => true,
                      'alloEmpty' => false,
                      'message' => '必ず入力して下さい'
                          ),
                    'pass_check' => array(
                      'rule' => 'notempty',
                      'required' => true,
                      'alloEmpty' => false,
                      'message' => '必ず入力して下さい'
                           ),
                    'email' => array(
                      'email' => array(
                        'rule' => 'email',
                        'required' => true,
                        'alloEmpty' => false,
                        'message' => 'メールアドレスの形式で必ず入力して下さい'
                        ),
                      "notempty" => array(
                           'rule' => 'notEmpty',
                           "message" => "入力してください"
                        )
                    )
                    
                );
    }