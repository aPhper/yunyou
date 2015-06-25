<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Manage_ticket extends CI_Controller
{

    private $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'form_validation',
            'common',
            'auth'
        ));
        $this->load->helper(array(
            'form',
            'url'
        ));
        if (! $this->auth->hasLogin()) {
            redirect(base_url('login'));
        }
        $user = $this->session->userdata('user_info');
        $this->_data['user_info'] = $user;
        $this->_data['ticket_type']=array(
            '1'=>'脚本',
            '2'=>'网站',
            '3'=>'其它'
        );
    }

    public function list_ticket()
    {
        $offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $limit = $this->config->item('ticket_list');
        $this->load->model(array(
            'ticket_mdl',
            'ticket_comment_mdl'
        ));
        $where = array(
            'col_uid' => $this->_data['user_info']['col_id']
        );
        $total = $this->ticket_comment_mdl->get_ticket_comment_num($where);
        $finished_ticket = $this->ticket_comment_mdl->list_ticket_and_comment(array(
            'tc.col_uid' => $this->_data['user_info']['col_id'],
            't.col_status' => 'Y'
        ), $limit, $offset);
        $unfinished_ticket = $this->ticket_comment_mdl->list_ticket_and_comment(array(
            'tc.col_uid' => $this->_data['user_info']['col_id'],
            't.col_status' => 'N'
        ), $limit, $offset);
        $this->_data['ticket']['finished'] = $finished_ticket;
        $this->_data['ticket']['unfinished'] = $unfinished_ticket;
        $this->load->view('list_ticket', $this->_data);
    }

    public function view_ticket()
    {
        $ticket_id = $this->uri->segment(3);
        if ($ticket_id) {
            $this->load->model('ticket_comment_mdl');
            $ticket = $this->ticket_comment_mdl->list_ticket_and_comment(array(
                'tc.col_id' => $ticket_id
            ));
            $this->_data['ticket'] = $ticket['0'];
            $this->load->view('view_ticket', $this->_data);
        } else {
            show_404();
        }
    }

    public function change_ticket()
    {
        $ticket_id = $this->uri->segment(3) ? $this->uri->segment(3) : $this->input->post('ticket_id');
        
        $this->load->model(array(
            'user_mdl',
            'ticket_comment_mdl'
        ));
        $user_list = $this->user_mdl->get_user_list(array(
            'col_role!=' => 'user',
            'col_role !=' => 'tech',
            'col_role  !=' => 'admin'
        ));
        $this->_data['user_list'] = $user_list;
        if ($ticket_id) {
            $this->_data['ticket_id'] = $ticket_id;
            if ($this->input->post('hidden') == 'hidden') {
                if ($this->ticket_comment_mdl->update_ticket_comment($ticket_id, array(
                    'col_uid' => $this->input->post('username')
                ))) {
                    $this->common->jump(base_url('manage_ticket/list_ticket'), '转单成功');
                } else {
                    $this->common->jump(base_url('manage_ticket/change_ticket/' . $ticket_id), '转单失败,重新尝试');
                }
            } else {
                $this->load->view('change_ticket', $this->_data);
            }
        } else {
            show_404();
        }
    }

    public function reply_ticket()
    {
        $ticket_id = $this->uri->segment(3) ? $this->uri->segment(3) : $this->input->post('ticket_id');
        $this->_data['ticket_id']=$ticket_id;
        $this->load->model(array('ticket_mdl','ticket_comment_mdl'));
        $ticket = $this->ticket_comment_mdl->list_ticket_and_comment(array(
                'tc.col_id' => $ticket_id
            ));
        $this->_data['ticket']=$ticket['0'];
        if ($this->input->post('hidden') == 'hidden') {
        if ($this->ticket_comment_mdl->update_ticket_comment($ticket_id, array(
                    'col_content' => $this->input->post('reply')
                ))&&$this->ticket_mdl->update_ticket($ticket['0']['col_id'],array('col_status'=>'Y'))) {
                    $this->common->jump(base_url('manage_ticket/list_ticket'), '回复成功');
                } else {
                    $this->common->jump(base_url('manage_ticket/change_ticket/' . $ticket_id), '回复失败,重新尝试');
                }
        } else {
            $this->load->view('reply_ticket',$this->_data);
        }
    }
}