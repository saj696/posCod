<?php
class Test_maraj extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('test_maraj/index');
    }
}

?>