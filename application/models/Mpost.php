<?php
class Mpost extends CI_Model {
    private $table = TBL__POSTS;

    function rules() {
        $rules = array(
            array(
                'field' => COL_POSTTITLE,
                'label' => 'Title',
                'rules' => 'required'
            ),
            /*array(
                'field' => COL_POSTSLUG,
                'label' => 'Slug',
                'rules' => 'required'
            ),
            array(
                'field' => COL_POSTCONTENT,
                'label' => 'Content',
                'rules' => 'required'
            ),*/
            /*array(
                'field' => COL_POSTEXPIREDDATE,
                'label' => 'Expired Date',
                'rules' => 'required'
            )*/
        );

        return $rules;
    }

    function getall($cat=null,$unitid=null) {
        $this->db->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner");
        if(!empty($cat)) {
          $this->db->where(TBL__POSTS.".".COL_POSTCATEGORYID, $cat);
        }
        if(!empty($unitid)) {
          $this->db->where(TBL__POSTS.".".COL_POSTUNITID, $unitid);
        } else {
          $this->db->where(TBL__POSTS.".".COL_POSTUNITID." is null");
        }
        $this->db->order_by(TBL__POSTS.".".COL_CREATEDON, "desc");
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }

    function search($limit=0,$keyword="",$type=null,$unitid=null,$not=null,$sortcol='') {
        $this->db->join(TBL__POSTCATEGORIES,TBL__POSTCATEGORIES.'.'.COL_POSTCATEGORYID." = ".TBL__POSTS.".".COL_POSTCATEGORYID,"inner");
        $this->db->join(TBL__USERINFORMATION,TBL__USERINFORMATION.'.'.COL_USERNAME." = ".TBL__POSTS.".".COL_CREATEDBY,"inner");

        if(!empty($keyword)) {
            $where = "(".TBL__POSTS.".".COL_POSTTITLE." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL__POSTS.".".COL_POSTSLUG." LIKE '%".$keyword."%'";
            $where .= " OR ".TBL__POSTS.".".COL_POSTCONTENT." LIKE '%".$keyword."%'";
            $where .= ")";

            $this->db->where($where);
        }
        if(!empty($type)) {
            if(is_array($type) && count($type) > 0) {
                $this->db->where_in(TBL__POSTS.".".COL_POSTCATEGORYID, $type);
            } else {
                $this->db->where(TBL__POSTS.".".COL_POSTCATEGORYID, $type);
            }
        }
        if(!empty($unitid)) {
          $this->db->where(TBL__POSTS.".".COL_POSTUNITID, $unitid);
        } else {
          $this->db->where(TBL__POSTS.".".COL_POSTUNITID." is null");
        }
        if(!empty($not)) {
          $this->db->where(TBL__POSTS.".".COL_POSTID." != ", $not);
        }
        if($limit > 0) $this->db->limit($limit);

        $this->db->where(TBL__POSTS.".".COL_ISSUSPEND, false);
        $this->db->where("(PostExpiredDate is null or PostExpiredDate >= '".date('Y-m-d')."')");
        if(!empty($sortcol)) {
          $this->db->order_by(TBL__POSTS.".".$sortcol, "asc");
        } else {
          $this->db->order_by(TBL__POSTS.".".COL_POSTDATE, "desc");
        }
        $res = $this->db->get($this->table)->result_array();
        return $res;
    }
}
