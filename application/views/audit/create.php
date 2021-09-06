<?php echo validation_errors(); ?>

<?php echo form_open('audit/create'); ?>
<div class="container col-md-8">

    <h1><?php echo $title ?></h1>

    <div class="row ">

        <div class="form-group">
            <label for="business_sel">Выбрать СМП</label>
            <select class="form-control" id="business_sel" name="business_name">
                <option>a</option>
                <option>b</option>
                <option>c</option>
            </select>
            <label for="supervisor_sel">Выбрать проверяющий орган</label>
            <select class="form-control" id="supervisor_sel" name="supervisor_name">
                <option>ь</option>
                <option>о</option>
                <option>ш</option>
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
                   value="<?php echo set_value('start_date'); ?>"
            />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="end_date">Дата Завершения</label><br/>
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

</form>