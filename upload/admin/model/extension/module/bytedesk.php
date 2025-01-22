<?php
class ModelExtensionModuleBytedeskLive extends Model {
    public function install() {
        $this->db->query("
            INSERT INTO " . DB_PREFIX . "setting 
            SET `code` = 'module_bytedesk', 
                `key` = 'module_bytedesk_status', 
                `value` = '1'
        ");
    }
    
    public function uninstall() {
        $this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = 'module_bytedesk'");
    }
} 