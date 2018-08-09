<?php
require_once Mage::getModuleDir('controllers', 'Mage_Contacts').DS.'IndexController.php';

class Magicstore_Lesson_Contacts_IndexController extends Mage_Contacts_IndexController
{

    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);

            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
               
                 // Загружаем хелпер
                $helper = Mage::helper('lesson');
                
                 // Загружаем модель
                $model = Mage::getModel('lesson/contact');
                
                // Передаем модели данные из POST
                $model->setData($post)->setId($this->getRequest()->getParam('request_id'));
                
                 //Сохраняем данные в модели
                $model->save();

                // Получаем Id модели (если мы создаем новую запись - id мы узнаем после сохранения)
                $id = $model->getId();
                
                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/*/');

                return;
                
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }
        } else {
            $this->_redirect('*/*/');
        }
    }
}
