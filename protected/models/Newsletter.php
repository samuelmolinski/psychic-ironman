<?php

/**
 * This is the model class for table "usuarionewsletter".
 *
 * The followings are the available columns in table 'usuarionewsletter':
 * @property string $Id
 * @property integer $IdGrupo
 * @property string $nome
 * @property string $email
 * @property string $assuntoInteresse
 * @property integer $tipo
 * @property string $uf
 * @property string $cidade
 * @property integer $jahFezDoacoes
 * @property integer $validado
 * @property string $dataCadastro
 * @property string $grupo
 * @property integer $exportado
 */
class Newsletter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Newsletter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarionewsletter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, email, uf, cidade, jahFezDoacoes', 'required'),
			array('IdGrupo, tipo, jahFezDoacoes, validado, exportado', 'numerical', 'integerOnly'=>true),
			array('Id', 'length', 'max'=>20),
			array('nome, email, assuntoInteresse, uf, cidade', 'length', 'max'=>100),
			array('grupo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, IdGrupo, nome, email, assuntoInteresse, tipo, uf, cidade, jahFezDoacoes, validado, dataCadastro, grupo, exportado', 'safe', 'on'=>'search'),
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
			'Id' => 'ID',
			'IdGrupo' => 'Id Grupo',
			'nome' => 'Nome',
			'email' => 'Email',
			'assuntoInteresse' => 'Assunto Interesse',
			'tipo' => 'Tipo',
			'uf' => 'Uf',
			'cidade' => 'Cidade',
			'jahFezDoacoes' => 'Ja Fez Doações',
			'validado' => 'Validado',
			'dataCadastro' => 'Data Cadastro',
			'grupo' => 'Grupo',
			'exportado' => 'Exportado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('IdGrupo',$this->IdGrupo);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('assuntoInteresse',$this->assuntoInteresse,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('uf',$this->uf,true);
		$criteria->compare('cidade',$this->cidade,true);
		$criteria->compare('jahFezDoacoes',$this->jahFezDoacoes);
		$criteria->compare('validado',$this->validado);
		$criteria->compare('dataCadastro',$this->dataCadastro,true);
		$criteria->compare('grupo',$this->grupo,true);
		$criteria->compare('exportado',$this->exportado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}