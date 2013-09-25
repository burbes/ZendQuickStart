<?php

class Application_Form_Post extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */

        /* CRIA O CAMPO TEXTO */
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->setLabel('Titulo:')
                ->setRequired(TRUE)
                ->setAllowEmpty(TRUE)
        // setDecorators - Encapsula 
        /* ->setDecorators(Array(
          'ViewHelper',
          // 'Label', <- pode ser assim aqui
          'Errors',
          'Description',
          // Array('HtmlTag',Array('tag'=>'div')),
          Array(Array('inner' =>'HtmlTag'),Array('tag'=>'div')),
          Array('Label',Array('tag'=>'p')),
          Array(Array('out'=>'HtmlTag'),Array('tag'=>'div','class'=>'out'))
          )) */;

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

        /* Método setElementDecorators - DEFINE AS CARACTERISTICAS DO FORMULARIO (DIFICÍLIMO, é melhor fazer na unha no phtml) */
        /*
          $this->setElementDecorators(Array(
          'ViewHelper',
          // 'Label', <- pode ser assim aqui
          'Errors',
          'Description',
          // Array('HtmlTag',Array('tag'=>'div')),
          Array(Array('inner' =>'HtmlTag'),Array('tag'=>'div')),
          Array('Label',Array('tag'=>'p')),
          Array(Array('out'=>'HtmlTag'),Array('tag'=>'div','class'=>'out'))
          ));
         */

        /* CRIA <DIV ID='MEU'><FORM></FORM></DIV> */
        $this->setDecorators(Array(
            'FormElements',
            'Form',
            Array('HtmlTag', Array('tag' => 'div', 'id' => 'meu')
            )
        ));

        /* DEFINE A AÇÃO DO POST */
        $this->setAction('/post/add');
    }

    /* PARA USAR AJAX DESABILITAR O LAYOUT
     * ESTE CODIGO ABAIXO DEVE FICAR NA ACTION ONDE SERÁ USADO O AJAX */
    /* public function ajaxAction() {
      $this->_helper->layout->disableLayout();
      $this->_helper->viewRenderer->setNoRender();
      //Seu código a ser executado
      } */
}

