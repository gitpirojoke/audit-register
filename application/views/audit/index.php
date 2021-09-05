
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
<script scr="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js"></script>

<div class="container"><h1><?php echo $title ?></h1></div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <p><a class="btn btn-success" href="<?php echo base_url('audit/create') ?>"> Новый аудит</a></p>
        </div>
    </div>
</div>

<div class="container">
    <table id="filter-table" class="table table-bordered">
        <thead>
        <tr>
            <th width="30px">№</th>
            <th class="col-sm-3">Проверяемый СМП</th>
            <th class="col-sm-3">Контролирующий орган</th>
            <th class="col-sm-3">Дата начала</th>
            <th class="col-sm-3">Дата завершения</th>
            <th class="sorter-false filter-false col-sm-3"></th>
        </tr>
        </thead>
        <tr class="col-filter">
            <th></th>
            <th><input type="text"/></th>
            <th><input type="text"/></th>
            <th><input type="date" class = "input-lg"/></th>
            <th><input type="date"/></th>
        </tr>
        <tbody>

        <?php foreach ($audit as $audit_item): ?>
            <tr class='table-data'>
                <td><?php echo $audit_item['id']; ?></td>
                <td><?php echo $audit_item['business_name']; ?></td>
                <td><?php echo $audit_item['supervisor_name']; ?></td>
                <td><?php echo $audit_item['start_date']; ?></td>
                <td><?php echo $audit_item['end_date']; ?></td>
                <td class="text-center">
                    <a class="btn btn-info" href="<?php echo base_url('audit/view/' . $audit_item['id']); ?>"><i
                                class="fa fa-eye fa-fw"></i></a>
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


<!--<div class="pagination ">
    <div class="mx-auto">
        <?php /*echo $links; */?>
    </div>
</div>-->


<!--<script type="text/javascript">
    $(document).ready(function() {
        $("#filter-table").tablesorter({ theme: "bootstrap", widgets: ['filter']});
    });
</script>

<script>
    $('.col-filter input').on('input', function () {
        filterTable($(this).parents('table'));
    });

    function filterTable($table) {
        var $filters = $table.find('.col-filter th');
        var $rows = $table.find('.table-data');
        $rows.each(function (rowIndex) {
            var valid = true;
            $(this).find('td').each(function (colIndex) {
                if ($filters.eq(colIndex).find('input').val()) {
                    if ($(this).html().toLowerCase().indexOf(
                        $filters.eq(colIndex).find('input').val().toLowerCase()) === -1) {
                        valid = valid && false;
                    }
                }
            });
            if (valid === true) {
                $(this).css('display', '');
            } else {
                $(this).css('display', 'none');
            }
        });
    }
</script>-->