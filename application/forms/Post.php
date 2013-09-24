<?php

class Application_Form_Post extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */

        /* CRIA O CAMPO TEXTO */
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->setLabel('Titulo:')
                ->setRequired(TRUE)
                ->setAllowEmpty(TRUE);

        /* CRIA O CAMPO TEXT AREA */
        $texto = new Zend_Form_Element_Textarea('texto');
        $texto->setLabel('Texto:')
                ->setRequired(TRUE) /* CAMPO OBRIGATORIO */
                ->setAllowEmpty(TRUE); /* NÁO PERMITE CAMPO NULO */

        /* CRIA O BOTÃO SUBMIT */
        $submit = new Zend_Form_Element_Submit('Enviar');
        $submit->setAttribs(Array('value' => 'Enviar'));

        /* AGREGA AO FORMULARIO OS ELEMENTOS */
        $this->addElements(Array($titulo, $texto, $submit));

        /* DEFINE A AÇÃO DO POST */
        $this->setAction('/post/add');
    }

    /* PARA USAR AJAX DESABILITAR O LAYOUT
     * ESTE CODIGO ABAIXO DEVE FICAR NA ACTION ONDE SERÁ USADO O AJAX */
    public function ajaxAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        //Seu código a ser executado
    }

}

