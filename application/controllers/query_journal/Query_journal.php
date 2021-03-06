<?php defined('BASEPATH') OR exit('No direct script access allowed');

class query_journal extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('query_journal/M_query_journal');

		$this->load->helper('url');
		
	}

	public function view_qj(){
		$data['page'] = 'query_journal/view_qj';
		$data['getGl'] = $this->M_query_journal->get_all_transaction();
		$this->load->view('template/template', $data);
	}

	public function detail_gl(){
			if (isset($_POST["transaction_detail"])) 
			{
				$output = '';
				$connect = mysqli_connect("localhost", "root", "", "gliem");
				$query =  "SELECT * from gl_header WHERE gl_no =  '".$_POST["transaction_detail"]."' ";
				$result = mysqli_query($connect, $query);

				$query2 =  "SELECT gl_detail.coa_id, coa.name_coa, gl_detail.debit, gl_detail.credit
				from gl_detail 
				JOIN coa
				ON coa.coa_id = gl_detail.coa_id
				where gl_detail.gl_no = '".$_POST["transaction_detail"]."' ";
				$result2 = mysqli_query($connect, $query2);
				

				$output .= '
				<div class="">
					<table class="table table-striped table-bordered table-hover dataTable table-po-detail">';

				while($row = mysqli_fetch_array($result)) {
					$output .= '
					 <div class="row">
                      <div class="col-md-3">
                        <label>VOUCHER NO.</label><br>
                        '.$row["gl_no"].'
                      </div>

                      <div class="col-md-3">
                        <label>GL DATE</label><br>
                        '.$row["gl_date"].'
                      </div>

                      <div class="col-md-3">
                        <label>FINANCIAL MONTH / YEAR</label><br>
                        '.$row["Fmonth"].' / '.$row["Fyear"].'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <label>DESCRIPTION</label><br>
                        '.$row["description"].'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>TOTAL</label><br>
                        '.number_format($row["total"]).'
                      </div>

                      <div class="col-md-3">
                        <label>REFERENCES</label><br>
                        '.$row["reff_no"].'
                      </div>

                      <div class="col-md-3">
                        <label>MODUL</label><br>
                        '.strtoupper($row["Fmodule"]).'
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>AUDIT USER</label><br>
                        '.$row["audit_user"].'
                      </div>

                      <div class="col-md-3">
                        <label>AUDIT DATE/TIME</label><br>
                        '.$row["audit_date"].'
                      </div>
                    </div><br>

                    
					 <tr>
					 	<td width="100px" align="center"><b>ACCOUNT</td>
					 	<td align="center"><b>DESCRIPTION</td>
					 	<td width="200px" align="center"><b>DEBIT</td>
					 	<td width="200px" align="center"><b>CREDIT</td>
					 </tr>

					';


				};


				while($row2 = mysqli_fetch_array($result2)) {
					$output .= '
					 <div class="row">
					 
					  <tr>
					 	<td>'.$row2["coa_id"].'</td>
					 	<td>'.$row2["name_coa"].'</td>
					 	<td align="right">'.number_format($row2['debit']).'</td>
					 	<td align="right">'.number_format($row2['credit']).'</td>
					 </tr>
					 </div>
					';

				
				};


				$output .= "</table></div>";
				echo $output;

			};
		}

	
}