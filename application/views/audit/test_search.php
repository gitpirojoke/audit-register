


<div id="container">
	<h1>CodeIgniter -Ajax Live Search..!</h1>




	<div class="row">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<div class="form-group">
					<div class="" style="width: 80%; margin: 0 auto; margin-bottom: 40px;margin-top: 20px;">
						<form action="<?php echo base_url() . 'tiktok/search' ?>" method="post">
							<input type="text" id="search_data" class="form-control search-input" name="search-term" placeholder="What are you looking for?" onkeyup="liveSearch()" autocomplete="off">
							<div id="suggestions">
								<div id="autoSuggestionsList">
								</div>
							</div>

						</form>

					</div>

				</div>




			</div>

		</div>
	</div>

</div>


<script>

	function liveSearch() {

		var input_data = $('#search_data').val();
		if (input_data.length === 0) {
			$('#suggestions').hide();
		} else {


			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>audit/liveSearch",
				data: {search_data: input_data},
				success: function (data) {
					// return success
					if (data.length > 0) {
						$('#suggestions').show();
						$('#autoSuggestionsList').addClass('auto_list');
						$('#autoSuggestionsList').html(data);
					}
				}
			});
		}
	}

</script>
