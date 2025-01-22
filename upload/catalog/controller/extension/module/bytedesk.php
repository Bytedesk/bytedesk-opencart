<?php
class ControllerExtensionModuleBytedeskLive extends Controller {
    public function index() {
        $this->load->model('setting/setting');
        
        $data['baseurl'] = $this->config->get('module_bytedesk_baseurl');
        $data['org'] = $this->config->get('module_bytedesk_org');
        $data['sid'] = $this->config->get('module_bytedesk_sid');
        
        return $this->load->view('extension/module/bytedesk', $data);
    }
} 