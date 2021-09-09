<?php echo validation_errors(); ?>

<?php echo form_open('audit/edit/'. $audit_item['id']); ?>
<div class="container col-md-8">

    <h1><?php echo $title ?></h1>

    <div class="row ">

        <div class="form-group">
            <label for="business_sel">Выбрать СМП</label>
<!--            <input class="form-control" id="business_sel" name="business_name">-->
            <select class="form-control" id="business_sel" name="business_name">
				<option><?php echo $audit_item['business_name'];?></option>
                <?php foreach ($business as $business_item): ?>
                    <option> <?php echo $business_item['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="supervisor_sel">Выбрать проверяющий орган</label>
            <select class="form-control" id="supervisor_sel" name="supervisor_name">
				<option><?php echo $audit_item['supervisor_name'];?></option>
            <?php foreach ($supervisors as $supervisor_item): ?>
                <option> <?php echo $supervisor_item['name']; ?></option>
            <?php endforeach; ?>
            </select>
        </div>


    </div>

    <div class="row">
        <div class="col">
            <label for="start_date">Дата начала</label><br/>
            <input type="date"
                   name="start_date"
                   id="start_date"
                   class="form-group"
                   value="<?php echo $audit_item['start_date']; ?>"
            />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="end_date">Дата завершения</label><br/>
            <input type="date"
                   name="end_date"
                   id="end_date"
                   class="form-group"
                   value="<?php echo $audit_item['end_date']; ?>"
            />
        </div>
    </div>


    <div class="row">
        <div class="col">
            <input type="submit"
                   name="submit"
                   class="btn btn-success"
                   value="Готово"
            />
        </div>
    </div>
</div>
<?php echo $audit_item['supervisor_name']; ?>
<?php //foreach ($audit_item as $aitem): ?>
<!--	<option> --><?php //echo $aitem['supervisor_name']; ?><!--</option>-->
<?php //endforeach; ?>
</div>

</form>
