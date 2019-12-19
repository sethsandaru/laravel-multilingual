<script type="text/x-template" id="action_template">
	<a href="@{{url.edit}}">
		<i class="fa fa-edit"></i>
	</a>
	|
	<a class="delete-btn" href="javascript:void(0);" data-url="@{{url.delete}}">
		<i class="fa fa-trash-o"></i>
	</a>
</script>

<script type="text/x-template" id="bundle_action_template">
	<a class="publish-btn" href="javascript:void(0);" data-url="@{{url.publish}}">
		<i class="fa fa-upload"></i>
	</a>
	|
	<a href="@{{url.edit}}">
		<i class="fa fa-edit"></i>
	</a>
	|
	<a class="delete-btn" href="javascript:void(0);" data-url="@{{url.delete}}">
		<i class="fa fa-trash-o"></i>
	</a>
</script>