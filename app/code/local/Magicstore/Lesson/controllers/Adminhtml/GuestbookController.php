<?php

class Magicstore_Lesson_Adminhtml_GuestbookController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Guestbook requests'))->_title($this->__('Our Guestbook1'));
        $this->loadLayout();
        $this->_setActiveMenu('cms/guest_book');
        $this->_addContent($this->getLayout()->createBlock('lesson/adminhtml_guestbook'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('lesson/adminhtml_guestbook_grid')->toHtml()
        );
    }

    public function exportCsvAction()
    {
        $fileName = 'contacts.csv';
        $grid = $this->getLayout()->createBlock('lesson/adminhtml_guestbook_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction()
    {
        $fileName = 'contacts.xml';
        $grid = $this->getLayout()->createBlock('lesson/adminhtml_guestbook_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    public function newAction()
    {
        // Одна форма для создания и редактирования
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Guestbook requests'));
        
        // 1. Получаем ID и создаем модель
        $id = (int)$this->getRequest()->getParam('request_id');
        $model = Mage::getModel('lesson/contact')->load($id);
        
        // 2. Проверяем наличие ID 
        if ($id) {
            $model->load($id);
            if (!$model->getRequestId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('lesson')->__('This block no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($model->getRequestId() ? $model->getTitle() : $this->__('New Request'));

        // 3. Set entered data if there is an error when we've saved it
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // 4. Регистрируем модель для дальнейшего испоьзования в блоках
        Mage::register('current_guestbook', $model);

        // 5. Строим форму-редактор
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('lesson/adminhtml_guestbook_edit'));
        $this->_setActiveMenu('cms/guest_book')
            ->_addBreadcrumb($id ? Mage::helper('lesson')->__('Edit Request') : Mage::helper('lesson')->__('New Request'), $id ? Mage::helper('lesson')->__('Edit Request') : Mage::helper('lesson')->__('New Request'))
            ->renderLayout();
    }

    public function saveAction() {
        /**
         * Получаем данные формы из POST
         */
        if ($data = $this->getRequest()->getPost()) {
            try {
                //var_dump($data);die;
               
                 // Загружаем хелпер
                $helper = Mage::helper('lesson');
                
                 // Загружаем модель
                $model = Mage::getModel('lesson/contact');
                
                // Передаем модели данные из POST
                $model->setData($data)->setId($this->getRequest()->getParam('request_id'));
                
                 //Сохраняем данные в модели
                $model->save();

                // Получаем Id модели (если мы создаем новую запись - id мы узнаем после сохранения)
                $id = $model->getId();
                
                 // Результат сохранения записываем в сессию и выводим сообщение
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Comment was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('request_id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        
        // Перебрасываем на страницу со списком
        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/guest_book');
    }
    
    public function deleteAction()
    {
        $tipId = $this->getRequest()->getParam('request_id', false);
 
        try {
            Mage::getModel('lesson/contact')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('lesson')->__('Comment successfully deleted'));
            
            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }
 
        $this->_redirect('*/*/');
    }
}
