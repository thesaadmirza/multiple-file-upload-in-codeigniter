<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property Files_model $files
 */
class Files extends back_end
{

    function __construct()
    {

        parent::__construct();

        $this->lang->load('files');
        $this->load->model('Files_model', 'files');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->form_validation->set_error_delimiters("<span class='incorrect'>", "</span>");
    }

    function index()
    {
        $this->overview();
    }

    /* This function display All files in datagrid */

    function overview()
    {
        $data['files'] = $this->files->get_all();
        $this->view('content/files_list', $data);
    }

    /* This function create ne files */

    function create()
    {
        $this->form_validation->set_rules('FileDesc', lang('FileDesc'), 'trim|required|htmlspecialchars');
        if ($this->form_validation->run($this) == FALSE) {
            $this->view('content/files_new');
        } else {
            if (!empty($_FILES)) {
                $files_url = $this->upload_file('files');
            } else {
                $files_url = NULL;
            }

            if ($this->is_multi($files_url)) {

                foreach ($files_url as $FileName) {
                    $this->files->create_files($FileName['file_name']);
                }
            } else {

                $this->files->create_files($files_url['file_name']);
            }
            redirect('files/overview/');
        }
    }


    function upload_file($file)
    {
        $this->load->library("upload");
        $upload_cfg['upload_path'] = "global/uploads/";
        $upload_cfg['encrypt_name'] = TRUE;
        $upload_cfg['allowed_types'] = "gif|jpg|png|jpeg";
/*        $upload_cfg['max_width'] = '1920'; /* max width of the image file */
/*        $upload_cfg['max_height'] = '1080'; /* max height of the image file */
/*        $upload_cfg['min_width'] = '300'; /* min width of the image file */
/*        $upload_cfg['min_height'] = '300'; /* min height of the image file */

        $this->upload->initialize($upload_cfg);

        if ($this->upload->do_upload($file)) {
            $image = $this->upload->data();
            $this->session->set_flashdata('success_msg', lang('success_msg_edit_cat'));
            return $image;
        } else {
            $msg = $this->form_validation->field_data['file_to_upload']['error'] = $this->upload->display_errors('', '');
            $this->session->set_flashdata('success_msg', $msg);
            redirect('files/overview/');
        }
    }

    /* This function remove files. */

    function remove($FileId)
    {

        $data['files'] = $this->files->get($FileId);
        if ($this->files->delete($FileId)) {
            if ($data['files']->FileName != null && file_exists(PUBPATH . "global/uploads/" . $data['files']->FileName)) {
                unlink(PUBPATH . "global/uploads/" . $data['files']->FileName);
            }
            $this->session->set_flashdata('success_msg', lang('success_msg_del'));
            redirect('files/overview/');
        }
    }

    /* This function edit files. */

    function edit($FileId)
    {
        $data['files'] = $this->files->get($FileId);
        $this->form_validation->set_rules('FileDesc', lang('FileDesc'), 'trim|required|htmlspecialchars');
        if ($this->form_validation->run($this) == FALSE) {
            $this->view('content/files_edit', $data);
        } else {
            if (!empty($_FILES['files']['name'])) {
                $files_url = $this->upload_file('files');
                if ($data['files']->FileName != null) {
                    if (file_exists(PUBPATH . "global/uploads/" . $data['files']->FileName)) {
                        unlink(PUBPATH . "global/uploads/" . $data['files']->FileName);
                    }
                }
            }

            $this->files->update_files($FileId,$files_url['file_name']);
            redirect('files/overview/');
        }
    }



    function is_multi($array)
    {

        return (count($array) != count($array, 1));
    }


}

/* End of file dashboard.php */

/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */