<?php

class MY_Controller extends CI_Controller{

    public $setting_org_name;
    public $setting_org_address;
    public $setting_org_lat;
    public $setting_org_long;
    public $setting_org_phone;
    public $setting_org_fax;
    public $setting_org_mail;

    public $setting_web_name;
    public $setting_web_desc;
    public $setting_web_logo;
    public $setting_web_disqus_url;
    public $setting_web_api_footerlink;
    public $setting_web_skin_class;
    public $setting_web_preloader;
    public $setting_web_version;

    function __construct(){
        parent::__construct();

        $this->setting_org_name = GetSetting(SETTING_ORG_NAME);
        $this->setting_org_address = GetSetting(SETTING_ORG_ADDRESS);
        $this->setting_org_lat = GetSetting(SETTING_ORG_LAT);
        $this->setting_org_long = GetSetting(SETTING_ORG_LONG);
        $this->setting_org_phone = GetSetting(SETTING_ORG_PHONE);
        $this->setting_org_fax = GetSetting(SETTING_ORG_FAX);
        $this->setting_org_mail = GetSetting(SETTING_ORG_MAIL);
        $this->setting_web_name = GetSetting(SETTING_WEB_NAME);
        $this->setting_web_desc = GetSetting(SETTING_WEB_DESC);
        $this->setting_web_disqus_url = GetSetting(SETTING_WEB_DISQUS_URL);
        $this->setting_web_api_footerlink = GetSetting(SETTING_WEB_API_FOOTERLINK);
        $this->setting_web_logo = GetSetting(SETTING_WEB_LOGO);
        $this->setting_web_skin_class = GetSetting(SETTING_WEB_SKIN_CLASS);
        $this->setting_web_version = GetSetting(SETTING_WEB_VERSION);
        $this->setting_web_preloader = GetSetting(SETTING_WEB_PRELOADER);

        if (!$this->input->is_ajax_request()) {
          $res = $this->db->insert(TBL__LOGS, array(
            COL_TIMESTAMP=>date('Y-m-d H:i:s'),
            COL_URL=>current_url(),
            COL_CLIENTINFO=>(!empty($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'').(!empty($_SERVER['HTTP_USER_AGENT'])?' '.$_SERVER['HTTP_USER_AGENT']:'')
          ));
        }
    }
}
