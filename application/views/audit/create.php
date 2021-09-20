<?php echo validation_errors(); ?>

<?php
/**
 * @var string $title
 * @var array $business
 * @var array $supervisors
 */
?>
<div class="container col-md-8 mx-auto">
	<?php echo form_open('audit/create'); ?>
    <div class="card mx-auto my-sm-3" style="width: 20rem;">
        <div class="card-header text-white flex-fill bg-primary">
            <h5 class="card-title "><?php echo $title ?></h5>
        </div>
        <div class="card-body">

            <div class="list-group ">
                <label for="business_sel">Выброр СМП</label>
                <select class="sel2" id="business_sel" name="business_name">
                    <?php foreach ($business as $business_item): ?>
                        <option> <?php echo $business_item['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="supervisor_sel">Выброр аудитора</label>
                <select class="sel2" id="supervisor_sel" name="supervisor_name">
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

            <div class="card-body text-center">
				<input type="submit" name="submit" class="btn btn-success" value="Добавить" style="width:100px;"/>
				<a class="btn btn-secondary" style="width:100px;" href="<?php echo base_url() ?>">Отмена</a>
            </div>
        </div>
    </div>
	</form>
</div>
