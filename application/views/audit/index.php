<?php
/**
 * @var string $title
 * @var array $audit
 * @var array $links
 */
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/filter.formatter.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js"></script>


<div class="container"><h1><?php echo $title ?></h1></div>
<!--<div>-->
<!---->
<!--</div>-->
<div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <div class="container">
                <p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcelModal">Импорт из excel</button>
                <a class="btn btn-success" href="<?php echo base_url('audit/exportExcel') ?>">Экспорт в excel</a>
                <a class="btn btn-success" href="<?php echo base_url('audit/create') ?>"> Новый аудит</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container table-responsive ">
    <table id="filter-table" class="table table-bordered ">
        <thead>
        <tr class="align-middle">
            <th class="col-sm-1">Код</th>
            <th class="col-sm-2">Проверяемый СМП</th>
            <th class="col-sm-2">Аудитор</th>
            <th class="col-sm-2">Дата начала</th>
            <th class="col-sm-2">Дата завершения</th>
            <th class="sorter-false filter-false col-sm-1"></th>
        </tr>
        </thead>
<!--        <tr class="col-filter">-->
<!--            <th></th>-->
<!--            <th><input type="text"/></th>-->
<!--            <th><input type="text"/></th>-->
<!--            <th><input type="date" class = "input-lg"/></th>-->
<!--            <th><input type="date"/></th>-->
<!--        </tr>-->
        <tbody>

        <?php foreach ($audit as $audit_item): ?>
            <tr class='table-data'>
                <td><?php echo $audit_item['id']; ?></td>
                <td><?php echo $audit_item['business_name']; ?></td>
                <td><?php echo $audit_item['supervisor_name']; ?></td>
                <td><?php echo $audit_item['start_date']; ?></td>
                <td><?php echo $audit_item['end_date']; ?></td>
                <td class="text-center">
                    <a class="btn btn-primary"
                       href="<?php echo base_url('audit/edit/' . $audit_item['id']); ?>"><i
                                class="fa fa-pencil-square-o fa-fw"></i></a>
                    <a class="btn btn-danger"
                       href="<?php echo base_url('audit/delete/' . $audit_item['id']); ?>"><i
                                class="fa fa-trash-o fa-fw"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>


<div class="pagination ">
    <div class="mx-auto">
        <?php echo $links; ?>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="importExcelModal" tabindex="-1"  aria-labelledby="importExcelModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="importExcelModalLabel">Импорт из Excel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<h5>Выбрерите файл</h5>
					<form id="dataImport" method="post" action="<?php echo base_url('audit/importExcel'); ?>"
						  enctype="multipart/form-data">
						<div class="form-group">
							<input type="file" name="upload_file" class="form-control-file" placeholder="Enter Name"
								   id="upload_file" required>
						</div>
					</form>
			</div>
			<div class="modal-footer">
				<button type="submit" form="dataImport" class="btn btn-primary">Импорт</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#filter-table").tablesorter({
            theme: "bootstrap",
            widgets: ['filter']});
    });
</script>
