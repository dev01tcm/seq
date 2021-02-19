<?php

/**
 * This is the model class for table "mas_user".
 *
 * The followings are the available columns in table 'mas_user':
 * @property integer $user_id
 * @property string $username
 * @property integer $usergroup
 * @property integer $department_id
 * @property integer $departmentgroup_id
 * @property integer $company_id
 * @property string $firstname
 * @property string $lastname
 * @property string $position
 * @property string $email
 * @property string $telno
 * @property string $mobileno
 * @property string $remark
 * @property string $lastedlogin_date
 * @property integer $status
 * @property string $create_date
 * @property integer $create_by
 * @property string $update_date
 * @property integer $update_by
 */
class mas_user extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mas_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usergroup, department_id, departmentgroup_id, company_id, status, create_by, update_by', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>40),
			array('firstname, lastname, position, telno, mobileno', 'length', 'max'=>200),
			array('email', 'length', 'max'=>320),
			array('remark', 'length', 'max'=>2000),
			array('lastedlogin_date, create_date, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, username, usergroup, department_id, departmentgroup_id, company_id, firstname, lastname, position, email, telno, mobileno, remark, lastedlogin_date, status, create_date, create_by, update_date, update_by', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'usergroup' => 'Usergroup',
			'department_id' => 'Department',
			'departmentgroup_id' => 'Departmentgroup',
			'company_id' => 'Company',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'position' => 'Position',
			'email' => 'Email',
			'telno' => 'Telno',
			'mobileno' => 'Mobileno',
			'remark' => 'Remark',
			'lastedlogin_date' => 'Lastedlogin Date',
			'status' => 'Status',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'update_date' => 'Update Date',
			'update_by' => 'Update By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('usergroup',$this->usergroup);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('departmentgroup_id',$this->departmentgroup_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telno',$this->telno,true);
		$criteria->compare('mobileno',$this->mobileno,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('lastedlogin_date',$this->lastedlogin_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('update_by',$this->update_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return mas_user the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
