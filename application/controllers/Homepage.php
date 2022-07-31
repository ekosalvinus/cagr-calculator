<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$data['judul'] = "CAGR";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('layout/adsenseone', $data);
		$this->load->view('cagr', $data);
		$this->load->view('layout/adsensethree', $data);
		$this->load->view('layout/adsensetwo', $data);
		$this->load->view('layout/footer', $data);
	}

	public function loan()
	{
		$data['judul'] = "LOAN";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('loan', $data);
		$this->load->view('layout/footer', $data);
	}

	public function about()
	{
		$data['judul'] = "ABOUT";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('about', $data);
		$this->load->view('layout/footer', $data);
	}

	public function disclaimer()
	{
		$data['judul'] = "DISCLAIMER";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('disclaimer', $data);
		$this->load->view('layout/footer', $data);
	}

	public function privacy()
	{
		$data['judul'] = "PRIVACY";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('privacy', $data);
		$this->load->view('layout/footer', $data);
	}

	public function support()
	{
		$data['judul'] = "SUPPORT";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar', $data);
		$this->load->view('support', $data);
		$this->load->view('layout/footer', $data);
	}
}
