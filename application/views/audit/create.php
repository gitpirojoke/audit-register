<?php echo validation_errors(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js"></script>

<?php
/**
 * @var string $title
 * @var array $business
 * @var array $supervisors
 */
?>
<div class="container col-md-8 mx-auto">
	<?php echo form_open('audit/create'); ?>
    <div class="card mx-auto" style="width: 20rem;">
        <div class="card-header text-white flex-fill bg-primary">
            <h5 class="card-title "><?php echo $title ?></h5>
        </div>
        <div class="card-body">

            <div class="list-group ">
                <label for="business_sel">Выбрать СМП</label>
                <select class="custom-select" id="business_sel" name="business_name">
                    <?php foreach ($business as $business_item): ?>
                        <option> <?php echo $business_item['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="supervisor_sel">Выбрать проверяющий орган</label>
                <select class="custom-select" id="supervisor_sel" name="supervisor_name">
                    <?php foreach ($supervisors as $supervisor_item): ?>
                        <option> <?php echo $supervisor_item['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

			<div class="list-group" >
				<label for="start_date">Дата начала</label>
				<div class="input-group date">
					<input id = "start_date"
						   type="text"
						   class="form-control datepicker"
						   name="start_date"
					/>
					<div class="input-group-addon input-group-append">
						<div class="input-group-text">
							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
						</div>
					</div>
				</div>
			</div>

			<div class="list-group" >
				<label for="end_date">Дата завершения</label>
				<div class="input-group date">
					<input id = "end_date"
						   type="text"
						   class="form-control datepicker"
						   name="end_date"
					/>
					<div class="input-group-addon input-group-append">
						<div class="input-group-text">
							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
						</div>
					</div>
				</div>
			</div>

            <div class="card-body ">
				<input type="submit" name="submit" class="btn btn-success" value="Добавить" style="width:100px;"/>
				<a class="btn btn-secondary" style="width:100px;" href="<?php echo base_url() ?>">Отмена</a>
            </div>
        </div>
    </div>
	</form>
</div>





<script type="text/javascript">
	$('.datepicker').datepicker({

		format: 'yyyy.mm.dd',
		language: 'ru',
		autoclose: 'true',
	});
</script>
