<?php
namespace Tests\Zend\Validate;

class AclTest extends \Tests\TestCase
{
    protected $classes = array(
        '\Zend_Form',
        '\Zend_Form_DisplayGroup',
        '\Zend_Form_Element',
        '\Zend_Form_Exception',
        '\Zend_Form_SubForm',
        '\Zend_Form_Decorator_Abstract',
        '\Zend_Form_Decorator_Callback',
        '\Zend_Form_Decorator_Captcha',
        '\Zend_Form_Decorator_Description',
        '\Zend_Form_Decorator_DtDdWrapper',
        '\Zend_Form_Decorator_Errors',
        '\Zend_Form_Decorator_Exception',
        '\Zend_Form_Decorator_Fieldset',
        '\Zend_Form_Decorator_File',
        '\Zend_Form_Decorator_Form',
        '\Zend_Form_Decorator_FormElements',
        '\Zend_Form_Decorator_FormErrors',
        '\Zend_Form_Decorator_HtmlTag',
        '\Zend_Form_Decorator_Image',
        '\Zend_Form_Decorator_Interface',
        '\Zend_Form_Decorator_Label',
        '\Zend_Form_Decorator_PrepareElements',
        '\Zend_Form_Decorator_Tooltip',
        '\Zend_Form_Decorator_ViewHelper',
        '\Zend_Form_Decorator_ViewScript',
        '\Zend_Form_Decorator_Captcha_ReCaptcha',
        '\Zend_Form_Decorator_Captcha_Word',
        '\Zend_Form_Decorator_Marker_File_Interface',
        '\Zend_Form_Element_Button',
        '\Zend_Form_Element_Captcha',
        '\Zend_Form_Element_Checkbox',
        '\Zend_Form_Element_Exception',
        '\Zend_Form_Element_File',
        '\Zend_Form_Element_Hash',
        '\Zend_Form_Element_Hidden',
        '\Zend_Form_Element_Image',
        '\Zend_Form_Element_Multi',
        '\Zend_Form_Element_MultiCheckbox',
        '\Zend_Form_Element_Multiselect',
        '\Zend_Form_Element_Note',
        '\Zend_Form_Element_Password',
        '\Zend_Form_Element_Radio',
        '\Zend_Form_Element_Reset',
        '\Zend_Form_Element_Select',
        '\Zend_Form_Element_Submit',
        '\Zend_Form_Element_Text',
        '\Zend_Form_Element_Textarea',
        '\Zend_Form_Element_Xhtml'
    );

    /**
     * Ensure that the composer autoloader is finding the classes correctly.
     */
    public function testCanFindClasses()
    {
        foreach ($this->classes as $class) {
            $this->assertTrue(class_exists($class) || interface_exists($class));
        }
    }

    public function testCanMakeBasicForm()
    {
        $input1 = new \Zend_Form_Element_Text('input1');
        $v1 = new \Zend_Validate_Alpha();
        $v1->setMessage("This field must only contain letters");

        $form = new \Zend_Form;
        $form->clearDecorators()->addElement($input1->clearDecorators()->addValidator($v1));
        $this->assertSame(1, $form->count());

        $this->assertFalse($form->isValid(array('input1'=>'rdfsdf344')));
        $this->assertSame("This field must only contain letters", current($form->getElement('input1')->getMessages()));
    }
}