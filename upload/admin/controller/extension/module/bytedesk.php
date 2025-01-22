<?php
class ControllerExtensionModuleBytedeskLive extends Controller {
    private $error = array();
    
    public function index() {
        $this->load->language('extension/module/bytedesk');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_bytedesk', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }
        
        // 加载配置数据
        $data['entry_baseurl'] = $this->language->get('entry_baseurl');
        $data['entry_org'] = $this->language->get('entry_org');
        $data['entry_sid'] = $this->language->get('entry_sid');
        
        if (isset($this->request->post['module_bytedesk_baseurl'])) {
            $data['module_bytedesk_baseurl'] = $this->request->post['module_bytedesk_baseurl'];
        } else {
            $data['module_bytedesk_baseurl'] = $this->config->get('module_bytedesk_baseurl');
        }
        
        if (isset($this->request->post['module_bytedesk_org'])) {
            $data['module_bytedesk_org'] = $this->request->post['module_bytedesk_org'];
        } else {
            $data['module_bytedesk_org'] = $this->config->get('module_bytedesk_org');
        }
        
        if (isset($this->request->post['module_bytedesk_sid'])) {
            $data['module_bytedesk_sid'] = $this->request->post['module_bytedesk_sid'];
        } else {
            $data['module_bytedesk_sid'] = $this->config->get('module_bytedesk_sid');
        }
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('extension/module/bytedesk', $data));
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/bytedesk')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
} 