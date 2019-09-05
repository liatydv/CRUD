<?php 
namespace Crud\Form;

use Zend\Form\Form;

class PostForm extends Form{

function __construct($name = null){
parent::__construct('post');
$this->setAttribute('method','POST');

    $this->add([
        'name' => 'id',
        'type' => 'hidden'
    ]);

    $this->add([
        'name' => 'nombre',
        'type' => 'text',
        'required' => true,
        'options' => [
            'label' => 'Nombre'
        ],
        'attribute' => 'required'
    ]);

    $this->add([
        'name' => 'correo',
        'type' => 'email',
        'options' => [
            'label' => 'Correo'
        ]
    ]);
    $this->add([
        'name' => 'contrasena',
        'type' => 'text',
        'options' => [
            'label' => 'Contraseña'
        ]
    ]);

    $this->add([
        'name' => 'submit',
        'type' => 'submit',
        'attributes' => [
            'value' => 'Guardar',
            'id' => 'buttonSave'
            
        ]
    ]);
        }   
    }
?>