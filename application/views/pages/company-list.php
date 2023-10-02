<div class="row">
<div class="col-12 text-end mb-3">
<a class="btn btn-primary" href="<?= base_url('download-csv');?>" id="exportCSV">Export CSV</a>
<button class="btn btn-info" type="button" id="insertCompanyData">Import Company</button>
</div>
<div class="col-12">
<table class="table table-bordered table-striped" id="companyTable">
<thead>
<tr>
<th>Sr.No</th>
<th>Name</th>
<th>Address</th>
<th>Pais</th>
<th>City</th>
<th>CIF</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($company_list->companies)){
$companies = $company_list->companies;
$count =1;
if (isset($companies) && is_array($companies)) { foreach ($companies as $company) { ?>
<tr>
<td><?= $count.'.';?></td>
<td><?=  $company->properties->name->value;?></td>
<td><?=  $company->properties->address->value;?></td>
<td><?=  $company->properties->pais->value;?></td>
<td><?=  $company->properties->city->value;?></td>
<td><?=  $company->properties->cif->value;?></td>
<td>
<a href="<?= base_url('welcome/company_edit/'.$company->companyId);?>" class="btn btn-info">Edit</a>
</td>
</tr>
<?php $count++; } } ?>
<?php } ?>
</tbody>
</table>
</div>
</div>
<script type="text/javascript">
$('#companyTable').DataTable();
$(document).on('click','#insertCompanyData',function(){
var button = $(this);
   var originalButtonText = button.html();
   button.html('Data Importing...');
$.ajax({
            url: "<?= base_url('insert-company-list');?>",
            method: "POST",
            dataType: "json",
            success: function(data) {
            button.html(originalButtonText);
            if(data.status=='true'){
               toastr.success(data.message);
               window.location.reload();
           }else{
            toastr.warning(data.message);
           }
            }
        });
});
</script>
