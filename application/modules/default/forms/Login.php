<?php

/*
 * após mover as pastas controller, forms, models, views, foi preciso renomear
 * de Application_Model_Post  para Default_Model_Post 
 *  */

class Default_Form_Login extends Zend_Form {

    public function init() {

        //campo login
        $this->addElement('text', 'login', array(
            'label' => 'Login',
            'required' => true,
            'filter' => array('StringTrim')
        ));
        
        //campo senha
        $this->addElement('password', 'senha', array(
            'label' => 'Senha',
            'required' => true,
            'filter' => array('StringTrim')
        ));
        
        $this->addElement('submit','Logar');
        
        $this->setMethod('post');
        
        
    }

}

