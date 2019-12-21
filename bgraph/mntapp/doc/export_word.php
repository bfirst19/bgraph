<?php
/*
require_once '../vendor/autoload.php';

$phpword = new \PhpOffice\PhpWord\PhpWord();
$section = $phpword->addSection();

$section->addText("Hello World!");
$file="Test-file";
$phpword->save(dirname(__FILE__)."/dir1"."/".$file.".docx");
*/

$str='<html><body><div id="container1" class="container">
	<div class="jumbotron">
		<div id="row1" class="row">
			<div class="col-md-4" align="left">
				<img class="img-fluid" src="../assets/images/logo.png" alt="Profile image">
			</div>

			<div class="col-md-8" align="right">
				<section>
					<h1 style="color: #1872c8;">BluGraph Technologies Pte Ltd</h1>
					<h4>7 Gambas Crescent</h4>
					<h4>#09-24 Ark@ Gambas</h4>
					<h4>Singapore 757087</h4>
				</section>


			</div>
		</div>
		<div id="container4" title="title-task">
			<h3 style="text-align: center;">Hydrometric and Hydrometeorological
				Services for Stormwater Management in Singapore (Third Contract)
				Monthly Maintenance Report – Rain Gauge</h3>
		</div>
		<hr class="style1">
		<div id="container5">
			<div id="row3" class="row col-sm-12">
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Station ID: <b>A1001</b>
						</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Station name:<b> Lakeside</b>
						</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<p>
							Maintenance Date &amp; Time: <b>2019-12-09 00:00:00</b>
						</p>
					</div>
				</div>
			</div>
		</div>
		<hr class="style2">
		<div id="container12">
	
	
<div class="table-responsive-sm"><table class="table table-bordered table-sm"><thead class="thead-light"><tr><th>S.No</th><th>Item</th><th>Description</th><th>Remarks</th>  </tr></thead><tbody><tr><td rowspan="3">1</td><td rowspan="3">Station</td><td>Structure, solar panel, sensor installation all in good condition?</td><td>yes</td></tr><tr><td>Station box door closed?</td><td>yes</td></tr><tr><td>Inside panel box not affected with water?</td><td>yes</td></tr><tr><td rowspan="2">2</td><td rowspan="2">Data Logger &amp; Battery</td><td>Data logger in good condition?</td><td>yes</td></tr><tr><td>Battery in good condition?</td><td>no</td></tr><tr><td rowspan="2">3</td><td rowspan="2">Sensor &amp; Cable</td><td>Sensor cleaned?</td><td>yes</td></tr><tr><td>Photo taken after maintenance?</td><td>no</td></tr><tr><td rowspan="1">4</td><td rowspan="1">Site measurement</td><td>Rainfall amount for volumetric test (mm)</td><td>-6.36</td></tr><tr><td rowspan="1">5</td><td rowspan="1">Website Data</td><td>Rainfall amount at start of volumetric test (mm)</td><td>5.69</td></tr></tbody></table></div></div>
		<div id="container14">
			Remarks: <br>
			<hr class="style1">
			<hr class="style1">
		</div>
		<div id="container15">
			<div id="row2" class="row col-md-12">
				<div id="mainTeam" class="col-md-6" align="left">
					<p>Maintenance Team</p>
					<br>
					<p style="">Name:<b> mnuse</b></p>
				</div>

				<div id="verifyTeam" class="col-md-6" align="left">
					<p>Verified By</p>
					<br>
					<p style="">Name:<b> prman</b></p>
				</div>
			</div>
		</div>
	</div>
</div></html></body>';

require_once '../vendor/autoload.php';

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$section = $phpWord->addSection();
\PhpOffice\PhpWord\Shared\Html::addHtml($section, $str);

//header('Content-Type: application/octet-stream');
//header('Content-Disposition: attachment;filename="test.docx"');

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

$file="Test-file";
$objWriter->save('/home/sel/vault/checklist/'.$file.".docx");

?>