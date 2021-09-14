<?php echo validation_errors(); ?>

<?php echo form_open('audit/create'); ?>
<div class="container col-md-8">

    <div class="card " style="width: 20rem;">
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



            <div class="row">
                <div class="col">
                    <label for="start_date">Дата начала</label><br/>
                    <input type="date"
                           name="start_date"
                           id="start_date"
                           class="form-group"
                           value="<?php echo set_value('start_date'); ?>"
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
                           value="<?php echo set_value('end_date'); ?>"
                    />
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <input type="submit"
                           name="submit"
                           class="btn btn-success"
                           value="Добавить"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
<?php //echo $business_test; ?>
</div>

</form>